<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('firstName', 'lastName', 'email', 'username', 'password', 'active', 'mobile', 'roleId');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function getUsersWithoutAdminAndSuperAdmin($rolesIds) {
        return User::whereIn('roleId',$rolesIds)->orderBy('username')->get();
    }

    public static function getUsersFromRoleId($role_id) {
        return User::where('roleId','=',$role_id)->orderBy('username')->get();
    }

    public static function getUserRoleName() {
        $roles = Role::getRoles();
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $user_role_name = "";
        foreach($roles as $r)
            if($r->id==$user->roleId)
                $user_role_name = $r->name;

        return $user_role_name;
    }

    public static function getSignedInUserId() {
        return Auth::user()->id;
    }
}
