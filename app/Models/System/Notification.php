<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * @package App\Models\System
 */
class Notification extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the users that belong to the notification
     *
     * @return BelongsToMany
     */
    public function recipients()
    {
        return $this->belongsToMany(User::class, 'notification_user', 'notification_id', 'receiver_id')->withPivot('read')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class);
    }


}
