<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\System\User;

/**
 * Class CategoryUser
 * @package App\Models\Business
 */
class CategoryUser extends Model
{

    /**
     * @var string
     */
    protected $table = 'category_user';

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
        'category_id',
        'user_id'
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

    /**
     * Relation with User.
     *
     * @return hasMany
     */
    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}