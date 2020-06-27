<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * @package App\Models\Business
 */
class Location extends Model
{

    /**
     * Delete logic
     */
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'location';

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
        'latitude',
        'longitude'
    ];
}