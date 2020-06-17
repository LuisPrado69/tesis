<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Canton
 * @package App\Models\System
 */
class Canton extends Model
{

    /**
     * @var string
     */
    protected $table = 'cantons';

    /**
     * @return BelongsTo
     */
    
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}