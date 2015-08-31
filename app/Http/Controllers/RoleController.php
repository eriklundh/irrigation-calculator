<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Validator;
use Illuminate\Http\Request;

class RoleController extends Controller {

    public function getList() {
        $user_role_name = User::getUserRoleName();
        $roles = Role::getRoles();
        return view('admin.roles.list', compact('user_role_name'), compact('roles'));
    }

    public function getCreate() {
        $user_role_name = User::getUserRoleName();
        return view('admin.roles.create', compact('user_role_name'));
    }
    public function postCreate(Request $request) {
        $validator = Validator::make($request->all(),
            array('name' => 'required')
        );

        if($validator->fails())
            return  redirect()->route('admin-roles-create')->withErrors($validator);
        else {
            $role = Role::create(array(
                'name' => $request->get('name')
            ));
            $arr = array('id'=>$role->id, 'name'=>$role->name);
            if($role) {
                $message = trans('language.ROLE-CREATED');
//                Logging::created('Role', $arr);
            }
            else {
                $message = trans('language.ROLE-NOT-CREATED');
//                Logging::not_created('Role', $arr);
            }
        }

        return  redirect()->route('admin-roles-list')
                ->with('global', $message);
    }

    public function getEdit($role_id) {
        $role = Role::find($role_id);
        $user_role_name = User::getUserRoleName();
        return view('admin.roles.edit', compact('user_role_name'), compact('role'));
    }
    public function postEdit(Request $request) {
        $validator = Validator::make($request->all(),
            array('name' => 'required')
        );

        if($validator->fails())
            return  redirect('/admin/roles/edit/'.$request->get('id'))
                    ->withErrors($validator)->withInput();
        else {
            $role = Role::find($request->get('id'));
            $role->name = $request->get('name');

            $arr = array('id'=>$role->id, 'name'=>$role->name);
            if($role->save()) {
                $message = trans('language.ROLE-EDITED');
//                Logging::edited('Role', $arr);
            }
            else {
                $message = trans('language.ROLE-NOT-EDITED');
//                Logging::not_edited('Role', $arr);
            }
        }
        return  redirect()->route('admin-roles-list')
                ->with('global', $message);
    }

    public function getDelete($role_id) {
        $role = Role::find($role_id);
        $user_role_name = User::getUserRoleName();
        $users = User::getUsersFromRoleId($role_id);
        return  view('admin.roles.delete', compact('role'))
                ->with(compact('user_role_name'))
                ->with('related_users_count', $users->count());
    }
    public function postDelete(Request $request) {
        $role = Role::findOrFail($request->get('id'));
        $arr = array('id'=>$role->id, 'name'=>$role->name);
        if($role->delete()) {
            $message = trans('language.ROLE-DELETED');
//            Logging::deleted('Role', $arr);
        }
        else {
            $message = trans('language.ROLE-NOT-DELETED');
//            Logging::not_deleted('Role', $arr);
        }
        return  redirect()->route('admin-roles-list')
                ->with('global', $message);
    }

}
