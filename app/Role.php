<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public function admin_users()
    {
        return $this->belongsToMany('App\AdminUsers','role_user','role_id','user_id');
    }
    public static function all_roles()
    {
        return Role::where('name','!=','no-role');
    }
}
