<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;


class Role extends SpatieRole
{
    use HasFactory;

    /**
     * @param bool $admin
     * @return mixed
     */
    public static function getRoleNames($admin = false)
    {
        return !$admin
            ? self::select('id', 'display_name')->where('name', '<>', 'admin')->get()
            : self::select('id', 'display_name', 'name')->get();
    }
}
