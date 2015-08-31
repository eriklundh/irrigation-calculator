@extends('layout.main')

@if($user_role_name=='ADMIN')
    @section('container')
        <div class="container">
            <h2 class="sub-header">Users
                <div>
                    <a href="{{ URL::route('admin-users-create') }}" class="btn btn-primary btn-sm">Create</a>
                </div>
            </h2>

            <div class="table-responsive">
                @if ($users->isEmpty())
                    <p>There are no users</p>
                @else
                    <h5 style="font-style: italic">Number: {{ $users_count }}</h5>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="center username">Username</th>
                            <th class="center email">Email</th>
                            <th class="center first-name">First-Name</th>
                            <th class="center last-name">Last-Name</th>
                            <th class="center mobile-phone">Mobile</th>
                            <th class="center activ">Active</th>
                            <th class="center roles">Roles</th>
                            <th class="center actions">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $u)
                        <tr>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->firstName }}</td>
                            <td>{{ $u->lastName }}</td>
                            <td class="center">{{ $u->mobile }}</td>
                            <td class="center">{{ $u->active }}</td>
                            <td class="center">{{ $selectRoles[$u->roleId] }}</td>
                            <td class="center">
                                <a href="{{ URL::route('admin-users-edit', $u->id) }}" class="btn btn-warning btn-xs">Edit</a>
                                <a href="{{ URL::route('admin-users-delete', $u->id) }}" class="btn btn-danger btn-xs">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @stop

@else

    @include('errors.access-denied')

@endif