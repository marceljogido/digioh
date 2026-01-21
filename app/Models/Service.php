<?php

namespace App\Models;

use App\Enums\ServiceStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Post\Models\Post;
use Spatie\Translatable\HasTranslations;

class Service extends BaseModel
{
    use HasTranslations;

    protected $table = 'services';

    public array $translatable = [
        'name',
        'description',
        'button_text',
        'features',
        'price',
        'price_note',
    ];

    protected $fillable = [
        'name',
        'category',
        'slug',
        'description',
        'features',
        'price',
        'price_note',
        'button_text',
        'icon',
        'status',
        'image',
        'video_url',
        'video_path',
        'gallery_images',
        'is_active',
        'featured_on_home',
        'sort_order',
    ];

    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            'featured_on_home' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'gallery_images' => 'array',
        ]);
    }

    public function scopeActive(Builder $q): void
    {
        $q->where('status', ServiceStatus::Published->value);
    }

    public function scopePublished(Builder $q): void
    {
        $this->scopeActive($q);
    }

    public function scopeSorted(Builder $q): void
    {
        $q->orderBy('sort_order')->orderBy('id');
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_service')->withTimestamps();
    }

    public function getVideoDataAttribute(): ?array
    {


        // Priority 2: Video URL (YouTube/Vimeo)
        $raw = trim((string) $this->video_url);

        if ($raw === '') {
            return null;
        }

        $provider = 'iframe';
        $embedUrl = $raw;
        $videoId = null;

        if (\Illuminate\Support\Str::contains($raw, ['youtube.com', 'youtu.be'])) {
            if (\Illuminate\Support\Str::contains($raw, 'watch')) {
                $query = [];
                parse_str(parse_url($raw, PHP_URL_QUERY) ?? '', $query);
                $videoId = $query['v'] ?? null;
            }

            if (! $videoId) {
                $path = trim((string) parse_url($raw, PHP_URL_PATH), '/');
                if ($path !== '') {
                    $segments = explode('/', $path);
                    $videoId = end($segments) ?: null;
                }
            }

            if ($videoId) {
                $provider = 'youtube';
                $embedUrl = 'https://www.youtube.com/embed/'.$videoId;
            }
        } elseif (\Illuminate\Support\Str::contains($raw, 'vimeo.com')) {
            if (preg_match('/player\.vimeo\.com\/video\/(\d+)/', $raw, $matches)) {
                $videoId = $matches[1];
            } elseif (preg_match('/vimeo\.com\/(\d+)/', $raw, $matches)) {
                $videoId = $matches[1];
            }

            if ($videoId) {
                $provider = 'vimeo';
                $embedUrl = 'https://player.vimeo.com/video/'.$videoId;
            }
        } elseif (\Illuminate\Support\Str::contains($raw, 'drive.google.com')) {
             $provider = 'google_drive';
             // Convert /view to /preview for embedding
             if (\Illuminate\Support\Str::contains($raw, '/view')) {
                 $embedUrl = str_replace('/view', '/preview', $raw);
             } elseif (!\Illuminate\Support\Str::contains($raw, '/preview')) {
                 // Try to append /preview if it looks like a file link
                 if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $raw)) {
                      $embedUrl = rtrim($raw, '/') . '/preview';
                 }
             }
        } elseif (\Illuminate\Support\Str::endsWith(\Illuminate\Support\Str::lower($raw), ['.mp4', '.webm', '.ogg'])) {
            $provider = 'file';
            $embedUrl = $raw;
        }

        return [
            'provider' => $provider,
            'embed_url' => $embedUrl,
            'source' => $raw,
            'is_file' => $provider === 'file',
        ];
    }
}
