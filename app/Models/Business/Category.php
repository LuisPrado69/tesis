<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models\Business
 */
class Category extends Model
{

    /**
     * Delete logic
     */
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'category';

    /**
     * @var bool
     */
    public $timestamps = true;

    // Category status
    const ACTIVE = 'ACTIVE';
    const INACTIVE = 'INACTIVE';
    const ACTIVE_TRANS = 'Activo';
    const INACTIVE_TRANS = 'Inactivo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status'
    ];
}