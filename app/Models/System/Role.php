<?php

namespace App\Models\System;

use SlonCorp\Acl\Models\Eloquent\Role as Acl;

/**
 * Class Role
 * @package App\Models\System
 */
class Role extends Acl
{

    /**
     *
     * @return bool
     */
    public function isAdminRole()
    {
        return $this->id === 1;
    }
}