<?php

namespace App\Models\Business;

use App\Models\System\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Events
 * @package App\Models\Business
 */
class Events extends Model
{

    /**
     * Delete logic
     */
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'events';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'date',
        'date_start',
        'date_end',
        'url',
        'status',
        'category_id',
        'location_id'
    ];

    /**
     * Relation with Category.
     *
     * @return hasMany
     */
    public function category()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }
}