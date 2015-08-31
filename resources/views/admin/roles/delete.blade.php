@extends('layout.main')

@if($user_role_name=='SUPER_ADMIN')

    @section('container')
        <div class="container">
            <h3 class="sub-header">Delete Role: '{{ $role->name }}'</h3>

            <form action='{{ URL::route("admin-roles-delete-post") }}' method='post'>
                <input type="hidden" name="id" value="{{ $role->id }}">
                @if($related_users_count>0)
                    The role cannot be deleted, because it is used in user roles!
                    <a href="{{ URL::route('admin-roles-list') }}" class="btn btn-default btn-small">Back</a>
                @else
                    Do you really want to delete it?
                    <button class="btn btn-danger btn-sm" type="submit">Yes</button>
                    <a href="{{ URL::route('admin-roles-list') }}" class="btn btn-default btn-small">No</a>
                @endif
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        </div>
    @stop

@else

    @include('errors.access-denied')

@endif