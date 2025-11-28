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
    ];

    protected $fillable = [
        'name',
        'category',
        'slug',
        'description',
        'icon',
        'status',
        'image',
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
}
