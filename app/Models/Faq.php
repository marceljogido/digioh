<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Faq extends BaseModel
{
    protected $table = 'faqs';

    protected $fillable = [
        'question',
        'question_en',
        'answer',
        'answer_en',
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
