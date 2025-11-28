<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Translatable\HasTranslations;

class Faq extends BaseModel
{
    use HasTranslations;

    protected $table = 'faqs';

    public array $translatable = [
        'question',
        'answer',
    ];

    protected $fillable = [
        'question',
        'answer',
        'is_active',
        'sort_order',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeSorted(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('id');
    }
}
