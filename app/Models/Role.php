<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public static function getName($id)
    {
        return static::find($id)->display_name;
    }
}
