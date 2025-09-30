<?php

namespace Modules\OurWork\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurWork extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'our_works';

    protected $fillable = [
        'name',
        'slug',
        'icon_class',
        'excerpt',
        'description',
        'featured_on_home',
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\OurWork\database\factories\OurWorkFactory::new();
    }
}
