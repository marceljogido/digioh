<?php

namespace Modules\Portfolio\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'portfolios';

    protected $fillable = [
        'name',
        'slug',
        'note',
        'status',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Portfolio\database\factories\PortfolioFactory::new();
    }
}
