<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class Shortcut extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the user that owns the shortcut
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}