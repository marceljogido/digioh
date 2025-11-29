<?php

namespace Modules\Post\Models;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Modules\Post\Enums\PostStatus;
use Modules\Post\Models\Presenters\PostPresenter;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends BaseModel
{
    use HasFactory;
    use LogsActivity;
    use Notifiable;
    use PostPresenter;
    use SoftDeletes;

    protected $table = 'posts';

    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            'event_start_date' => 'datetime',
            'event_end_date' => 'datetime',
            'is_our_work' => 'boolean',
            'our_work_sort_order' => 'integer',
            'gallery_images' => 'array',
        ]);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName($this->table);
    }

    public function category()
    {
        return $this->belongsTo('Modules\Category\Models\Category');
    }

    public function tags()
    {
        return $this->morphToMany('Modules\Tag\Models\Tag', 'taggable');
    }

    public function scopePublishedAndScheduled($query)
    {
        return $query->where('status', '=', PostStatus::Published->value);
    }

    /**
     * Get the list of Published Articles.
     *
     * @param [type] $query [description]
     * @return [type] [description]
     */
    public function scopePublished($query)
    {
        return $query->publishedAndScheduled()->where('published_at', '<=', Carbon::now());
    }

    public function scopeFeatured($query)
    {
        return $query->publishedAndScheduled()->where('is_featured', '=', 1)->orderByDesc('published_at');
    }

    /**
     * Get the list of Recently Published Articles.
     *
     * @param [type] $query [description]
     * @return [type] [description]
     */
    public function scopeRecentlyPublished($query)
    {
        return $query->publishedAndScheduled()->orderBy('published_at', 'desc');
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Service::class, 'post_service')->withTimestamps();
    }

    public function setScopeOfWorkAttribute($value): void
    {
        if (is_array($value)) {
            $value = collect($value)
                ->map(fn ($item) => trim((string) $item))
                ->filter()
                ->implode(', ');
        }

        $this->attributes['scope_of_work'] = $value;
    }

    public function getScopeOfWorkListAttribute(): array
    {
        if (blank($this->attributes['scope_of_work'] ?? null)) {
            return [];
        }

        return collect(explode(',', (string) $this->attributes['scope_of_work']))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    public function getHighlightVideoDataAttribute(): ?array
    {
        $raw = trim((string) ($this->attributes['highlight_video_url'] ?? ''));

        if ($raw === '') {
            return null;
        }

        $provider = 'iframe';
        $embedUrl = $raw;
        $thumbnail = null;
        $videoId = null;

        if (Str::contains($raw, ['youtube.com', 'youtu.be'])) {
            if (Str::contains($raw, 'watch')) {
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
                $thumbnail = 'https://img.youtube.com/vi/'.$videoId.'/hqdefault.jpg';
            }
        } elseif (Str::contains($raw, 'vimeo.com')) {
            if (preg_match('/player\.vimeo\.com\/video\/(\d+)/', $raw, $matches)) {
                $videoId = $matches[1];
            } elseif (preg_match('/vimeo\.com\/(\d+)/', $raw, $matches)) {
                $videoId = $matches[1];
            }

            if ($videoId) {
                $provider = 'vimeo';
                $embedUrl = 'https://player.vimeo.com/video/'.$videoId;
            }
        } elseif (Str::endsWith(Str::lower($raw), ['.mp4', '.webm', '.ogg'])) {
            $provider = 'file';
            $embedUrl = $raw;
        }

        return [
            'provider' => $provider,
            'embed_url' => $embedUrl,
            'source' => $raw,
            'thumbnail' => $thumbnail,
            'is_file' => $provider === 'file',
        ];
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Post\database\factories\PostFactory::new();
    }
}
