<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Stat extends Model
{
    protected $fillable = [
        'value',
        'label',
        'label_en',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'value' => 'string',
        'label' => 'string',
        'label_en' => 'string'
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
