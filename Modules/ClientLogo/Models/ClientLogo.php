<?php

namespace Modules\ClientLogo\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientLogo extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'client_logos';

    protected $fillable = [
        'client_name',
        'logo',
        'website_url',
        'is_active',
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\ClientLogo\database\factories\ClientLogoFactory::new();
    }
}
