@extends('layout.main')

@if($user_role_name=='SUPER_ADMIN')

    @section('container')
        <div class="container">
            <h2 class="sub-header">Roles
                <div>
                    <a href="{{ URL::route('admin-roles-create') }}" class="btn btn-primary btn-sm">Create</a>
                </div>
            </h2>

            <div class="table-responsive">
                @if ($roles->isEmpty())
                    <p>There are no roles</p>
                @else
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="center">Name</th>
                            <th class="center actions">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td class="center">
                                <a href="{{ URL::route('admin-roles-edit', $role->id) }}" class="btn btn-warning btn-xs">Edit</a>
                                <a href="{{ URL::route('admin-roles-delete', $role->id) }}" class="btn btn-danger btn-xs">Delete</a>
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