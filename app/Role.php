<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    protected $fillable = array('name');

    public static function getRoles() {
        $roles = Role::all();
        return $roles;
    }

    public static function getRolesWithoutAdminAndSuperAdmin() {
        $roles = Role::where('name','!=','ADMIN')
                    ->where('name','!=','SUPER_ADMIN')->orderBy('name')->get();
        return $roles;
    }

    public static function getSelectRoles($roles) {
        $selectRoles = array();
        foreach($roles as $r)
            $selectRoles[$r->id] = $r->name;
        return $selectRoles;
    }

    public static function getRolesIds($roles) {
        $rolesIds = array(0);
        foreach($roles as $r)
            array_push($rolesIds, $r->id);
        return $rolesIds;
    }

}