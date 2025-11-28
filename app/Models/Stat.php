<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Stat extends Model
{
    use HasTranslations;

    protected $fillable = [
        'value',
        'label',
        'sort_order',
        'is_active',
    ];

    public array $translatable = [
        'label',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'value' => 'string',
    ];

    public function scopeActive(Builder $q): void
    {
        $q->where('is_active', true);
    }

    public function scopeSorted(Builder $q): void
    {
        $q->orderBy('sort_order')->orderBy('id');
    }
}
