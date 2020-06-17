<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use SlonCorp\Acl\Models\Eloquent\User as Acl;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models\System
 */
class User extends Acl
{

    use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the user full name.
     *
     * @return string
     */
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function fullNameWithLastNameFirst()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    /**
     * Test if user has photo
     *
     * @return bool
     */
    public function hasPhoto()
    {
        return null != $this->photo;
    }

    /**
     * Get the path for the user photo
     *
     * @return string
     */
    public function photoPath()
    {
        if ($this->hasPhoto()) {
            return 'assets/images/images/' . $this->photo;
        }
        return 'assets/images/user.png';
    }

    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this
            ->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Get the notifications that belong to the user
     *
     * @return BelongsToMany
     */
    public function notifications()
    {
        return $this
            ->belongsToMany(Notification::class, 'notification_user', 'receiver_id', 'notification_id')
            ->withPivot('read');
    }

    /**
     * Get the latest notifications that belong to the user
     *
     * @return mixed
     */
    public function latestNotifications()
    {
        return $this->notifications()->latest()->get();
    }

    /**
     * Obtain bool if is admin o superadmin
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->id === 1;
    }
}
