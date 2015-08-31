@extends('layout.main')

@if($user_role_name=='ADMIN')

    @section('container')
        <div class="container">
            <h3 class="sub-header">Delete User: {{ $user->username." - ".$user->firstName." ".$user->lastName }}</h3>

            <form action='{{ URL::route("admin-users-delete-post") }}' method='post'>
                <input type="hidden" name="id" value="{{ $user->id }}">
                {{-- @if($related_users_count>0) --}}
                    {{-- trans('language.USER-NOT-DELETED-USER-ROLE') --}}
<!--                    <a href="{{-- URL::route('admin-users-list') --}}" class="btn btn-default btn-sm">Back</a>-->
                {{-- @else --}}
                    Do you really want to delete it?
                    <button class="btn btn-danger btn-sm" type="submit">Yes</button>
                    <a href="{{ URL::route('admin-users-list') }}" class="btn btn-default btn-sm">No</a>
                {{-- @endif --}}
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        </div>
    @stop

@else

    @include('errors.access-denied')

@endif