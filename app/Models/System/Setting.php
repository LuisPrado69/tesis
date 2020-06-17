<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App\Models\System
 */
class Setting extends Model
{

    /**
     * @var string
     */
    protected $table = 'settings';

    /**
     * Get data
     *
     * @param $value
     * @return mixed
     */
    public function getValueAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        return json_decode($value, true);
    }

    /**
     * Set data
     *
     * @param $value
     */
    public function setValueAttribute($value)
    {
        // if nothing being set, clear configuration
        if (empty($value) || !is_array($value)) {
            $this->attributes['value'] = '{}';
            return;
        }

        // store as json.
        $this->attributes['value'] = json_encode($value);
    }

}
