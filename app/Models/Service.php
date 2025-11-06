<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Post\Models\Post;

class Service extends BaseModel
{
    protected $table = 'services';

    protected $fillable = [
        'name',
        'name_en',
        'category',
        'slug',
        'description',
        'description_en',
        'icon',
        'image',
        'is_active',
        'featured_on_home',
        'sort_order',
    ];

    public function scopeActive(Builder $q): void
    {
        $q->where('is_active', true);
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
