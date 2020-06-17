<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Province
 * @package App\Models\System
 */
class Province extends Model
{

    /**
     * @var string
     */
    protected $table = 'provinces';

    /**
     * @return BelongsToMany
     */
    public function cantons()
    {
        return $this->belongsToMany(Canton::class);
    }
}