<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 * @package App\Models\System
 */
class Menu extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the parent that owns the menu.
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
    
    /**
     * Get the children for the menu.
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
