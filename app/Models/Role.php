<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    const SUPER_ADMIN='superadmin';
    const ADMIN='admin';
    const USER='user';


    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
}
