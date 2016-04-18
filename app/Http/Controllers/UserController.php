<?php

namespace App\Http\Controllers;

use App\Config;
use App\Role;
use App\Upload;
use App\User;
use App\UserRole;
use Validator;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller {

    public function getList() {
        $user_role_name = User::getUserRoleName();

        $roles = Role::getRolesWithoutAdminAndSuperAdmin();
        $selectRoles = Role::getSelectRoles($roles);
        $rolesIds = Role::getRolesIds($roles);

        $users = User::getUsersWithoutAdminAndSuperAdmin($rolesIds);
        $users_count = $users->count();

        return  view('admin.users.list')
                ->with(compact('user_role_name'))
                ->with(compact('selectRoles'))
                ->with(compact('users'))
                ->with('users_count', $users_count);
    }

    public function getCreate() {
        $user_role_name = User::getUserRoleName();
        $roles = Role::getRolesWithoutAdminAndSuperAdmin();
        return view('admin.users.create', compact('user_role_name'))
                ->with(compact('roles'));
    }
    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(),
            array(
                'firstName' => 'required',
                'lastName'  => 'required',
                'username'  => 'required|max:20|min:3|unique:users',
                'password'  => 'required|min:6',
                'email'     => 'required|max:50|email|unique:users',
                'roleId'    => 'integer|min:1'
            )
        );

        if($validator->fails())
            return  redirect()->route('admin-users-create')
                    ->withErrors($validator)->withInput();
        else {

            $user = User::create(array(
                'firstName' => $request->get('firstName'),
                'lastName'  => $request->get('lastName'),
                'username'  => $request->get('username'),
                'password'  => Hash::make($request->get('password')),
                'email'     => $request->get('email'),
                'active'    => ($request->has('active')) ? true : false,
                'mobile'    => $request->get('mobile'),
                'roleId'    => $request->get('roleId')
            ));
            $arr = array('id'=>$user->id, 'firstName'=>$user->firstName, 'lastName'=>$user->lastName,
                'username'=>$user->username, 'email'=>$user->email, 'active'=>$user->active, 'mobile'=>$user->mobile);
            if($user) {
                //$message = trans('language.USER-CREATED');
                $message = 'User has been created.';
                //Logging::created('User', $arr);
            }
            else {
                //$message = trans('language.USER-NOT-CREATED');
                $message = 'User can not be created, please try again.';
                //Logging::not_created('User', $arr);
            }

            $copy1 = copy('output/crops.xlsx', 'uploads/'.$user->id.'$crops.xlsx');
            $result = Upload::uploadInputFile(Config::getUploadBaseDirectory().'uploads/'.$user->id.'$crops.xlsx', 'crop', $user->id);
            if($copy1==true and strpos($result, 'Uploaded')!==false) $state='1'; else $state='0';

            $copy2 = copy('output/soils.xlsx', 'uploads/'.$user->id.'$soils.xlsx');
            $result = Upload::uploadInputFile(Config::getUploadBaseDirectory().'uploads/'.$user->id.'$soils.xlsx', 'soil', $user->id);
            if($copy2==true and strpos($result, 'Uploaded')!==false) $state.='-1'; else $state.='-0';

            $copy3 = copy('output/efficiency.xlsx', 'uploads/'.$user->id.'$efficiency.xlsx');
            $result = Upload::uploadInputFile(Config::getUploadBaseDirectory().'uploads/'.$user->id.'$efficiency.xlsx', 'efficiency', $user->id);
            if($copy3==true and strpos($result, 'Uploaded')!==false) $state.='-1'; else $state.='-0';

            $copy4 = copy('output/yield.xlsx', 'uploads/'.$user->id.'$yield.xlsx');
            $result = Upload::uploadInputFile(Config::getUploadBaseDirectory().'uploads/'.$user->id.'$yield.xlsx', 'yield', $user->id);
            if($copy4==true and strpos($result, 'Uploaded')!==false) $state.='-1'; else $state.='-0';

            $state .= '-0-0-0-0-0-0';
            $upload = Upload::create(array(
                'userId' => $user->id,
                'state'  => $state
            ));

            if($copy1==true) {
                $upload->crop = 'crops.xlsx';
                $upload->crop_at = date('Y-m-d H:i:s');
                $upload->save();
            }
            if($copy2==true) {
                $upload->soil = 'soils.xlsx';
                $upload->soil_at = date('Y-m-d H:i:s');
                $upload->save();
            }
            if($copy3==true) {
                $upload->efficiency = 'efficiency.xlsx';
                $upload->efficiency_at = date('Y-m-d H:i:s');
                $upload->save();
            }
            if($copy4==true) {
                $upload->yield = 'yield.xlsx';
                $upload->yield_at = date('Y-m-d H:i:s');
                $upload->save();
            }
        }

        return  redirect()->route('admin-users-list')
                ->with('global', $message);
    }

    public function getEdit($user_id) {
        $user_role_name = User::getUserRoleName();
        $user = User::find($user_id);
        $roles = Role::getRolesWithoutAdminAndSuperAdmin();
        return view('admin.users.edit', compact('user'), compact('user_role_name'))
                ->with(compact('roles'));
    }
    public function postEdit(Request $request) {
        $validator = Validator::make($request->all(),
            array(
                'firstName' => 'required',
                'lastName'  => 'required',
                'username'  => 'required|max:20|min:3|unique:users,username,'.$request->get('id'),
                'password'  => 'min:6',
                'email'     => 'max:50|email|unique:users,email,'.$request->get('id'),
                'roleId'    => 'integer|min:1'
            )
        );

        if($validator->fails())
            return  redirect('/admin/users/edit/'.$request->get('id'))
                    ->withErrors($validator)->withInput();
        else {
            $user = User::find($request->get('id')); //findOrFail

            $user->firstName    = $request->get('firstName');
            $user->lastName     = $request->get('lastName');
            $user->username     = $request->get('username');
            if(strlen(trim($request->get('password')))!=0)
                $user->password     = Hash::make($request->get('password'));
            $user->email        = $request->get('email');
            $user->active       = ($request->has('active')) ? true : false;
            $user->mobile       = $request->get('mobile');

            $arr = array('id'=>$user->id, 'firstName'=>$user->firstName, 'lastName'=>$user->lastName,
                'username'=>$user->username, 'email'=>$user->email, 'active'=>$user->active, 'mobile'=>$user->mobile);
            if($user->save()) {
                //$message = trans('language.USER-EDITED');
                $message = 'User has been edited.';
                //Logging::edited('User', $arr);
            }
            else {
                //$message = trans('language.USER-NOT-EDITED');
                $message = 'User can not be edited, please try again.';
                //Logging::not_edited('User', $arr);
            }
        }
        return  redirect()->route('admin-users-list')
                ->with('global', $message);
    }

    public function getDelete($user_id) {
        $user_role_name = User::getUserRoleName();
        $user = User::find($user_id);
        //$userRoles = UserRole::getUserRolesFromUserId($user_id);
        return  view('admin.users.delete', compact('user'))
                ->with(compact('user_role_name'));
                //->with('related_users_count', $userRoles->count());
    }

    public function postDelete(Request $request) {
        $user = User::findOrFail($request->get('id'));
        $arr = array('id'=>$user->id, 'firstName'=>$user->firstName, 'lastName'=>$user->lastName,
            'username'=>$user->username, 'email'=>$user->email, 'active'=>$user->active, 'mobile'=>$user->mobile);
        if($user->delete()) {
            //$message = trans('language.USER-DELETED');
            $message = 'User has been deleted.';
//            Logging::deleted('User', $arr);
        }
        else {
            //$message = trans('language.USER-NOT-DELETED');
            $message = 'User can not be deleted, please try again.';
//            Logging::not_deleted('User', $arr);
        }
        return  redirect()->route('admin-users-list')
                ->with('global', $message);
    }

}
