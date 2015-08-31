@extends('layout.main')

@if($user_role_name=='ADMIN')

    @section('container')
        <div class="container">
            <h3 class="sub-header">Edit User</h3>

            <div class="table-responsive">
                <form action='{{ URL::route("admin-users-edit-post") }}' method='post'>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <table>
                        <tbody>
                        <tr>
                            <td><span>First Name :</span></td>
                            <td><input class="form-control" type="text" name="firstName" value="{{ (old('firstName')) ? e(old('firstName')) : $user->firstName }}"></td>
                            <td>
                                @if($errors->has('firstName'))
                                <span class="error">{{ $errors->first('firstName') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><span>Last Name :</span></td>
                            <td><input class="form-control" type="text" name="lastName" value="{{ (old('lastName')) ? e(old('lastName')) : $user->lastName }}"></td>
                            <td>
                                @if($errors->has('lastName'))
                                <span class="error">{{ $errors->first('lastName') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><span>Username :</span></td>
                            <td><input class="form-control" type="text" name="username" value="{{ (old('username')) ? e(old('username')) : $user->username }}"></td>
                            <td>
                                @if($errors->has('username'))
                                <span class="error">{{ $errors->first('username') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><span>Password :</span></td>
                            <td><input class="form-control" type="password" name="password"></td>
                            <td>
                                @if($errors->has('password'))
                                <span class="error">{{ $errors->first('password') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><span>Email :</span></td>
                            <td><input class="form-control" type="text" name="email" value="{{ (old('email')) ? e(old('email')) : $user->email }}"></td>
                            <td>
                                @if($errors->has('email'))
                                <span class="error">{{ $errors->first('email') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><span>Mobile :</span></td>
                            <td><input class="form-control" type="text" name="mobile" value="{{ (old('mobile')) ? e(old('mobile')) : $user->mobile }}"></td>
                            <td>
                                @if($errors->has('mobile'))
                                <span class="error">{{ $errors->first('mobile') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><span>Role :</span></td>
                            <td>
                                <select name="roleId" class="form-control">
                                    <option value="0">Choose</option>
                                    @foreach($roles as $r)
                                        @if(old('roleId'))
                                            @if(old('roleId')==$r->id)
                                                <option value="{{ $r->id }}" selected>{{ $r->name }}</option>
                                            @else
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                            @endif
                                        @else
                                            @if($r->id==$user->roleId)
                                                <option value="{{ $r->id }}" selected>{{ $r->name }}</option>
                                            @else
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            <td>
                                @if($errors->has('roleId'))
                                <span class="error">{{ $errors->first('roleId') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><span>Active :</span></td>
                            <td>
                                @if(old('active'))
                                    <input type="checkbox" name="active" checked>
                                @else
                                    <input type="checkbox" name="active">
                                @endif
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td class="right">
                                <a href="{{ URL::route('admin-users-list') }}" class="btn btn-link">Cancel</a>
                                <button class="btn btn-primary btn-sm" type="submit">Edit</button>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>
            </div>
        </div>
    @stop

@else

    @include('errors.access-denied')

@endif