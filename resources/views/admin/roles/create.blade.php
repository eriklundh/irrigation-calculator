@extends('layout.main')

@if($user_role_name=='SUPER_ADMIN')

    @section('container')
        <div class="container">
            <h3 class="sub-header">Create Role</h3>

            <div class="table-responsive">
                <form action='{{ URL::route("admin-roles-create-post") }}' method='post'>
                    <table>
                        <tbody>
                        <tr>
                            <td><span>Name :</span></td>
                            <td><input class="form-control" type="text" name="name"></td>
                            <td>
                                @if($errors->has('name'))
                                <span class="error">{{ $errors->first('name') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td class="right">
                                <a href="{{ URL::route('admin-roles-list') }}" class="btn btn-link">Cancel</a>
                                <button class="btn btn-primary btn-sm" type="submit">Create</button>
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