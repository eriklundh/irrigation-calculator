@extends('layout.main')

@section('css')
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
@stop

@section('container')
    <div class="container">

        <form class="form-signin" action='{{ URL::route("account-sign-in-post") }}' method='post'>
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="username" class="sr-only">Username</label>
            <input type="text" id="username" class="form-control" placeholder="username" name="username" required autofocus>
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" class="form-control" placeholder="password" name="password" required>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me" name="remember"> Remember me
                </label>
                <a href="{{ URL::route('account-forgot-password') }}">Forgot-password</a>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        </form>

    </div> <!-- /container -->
@stop