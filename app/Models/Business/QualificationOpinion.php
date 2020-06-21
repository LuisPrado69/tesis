<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\System\User;

/**
 * Class QualificationOpinion
 * @package App\Models\Business
 */
class QualificationOpinion extends Model
{

    /**
     * Delete logic
     */
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'qualification_opinion';

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
        'event_id',
        'user_id',
        'comment',
        'stars'
    ];

    /**
     * Relation with Events.
     *
     * @return hasMany
     */
    public function events()
    {
        return $this->hasMany(Events::class, 'event_id', 'id');
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