@extends('layout.main')

@section('container')
    <div id="change-password-page">
        <h1 class="title">{{ trans('language.Change-the-password') }}</h1>
        <form action="{{ URL::route('account-change-password-post') }}" method="post">
            <div class="field">
                <input placeholder="{{ trans('language.Old-password') }}" type="password" name="old_password">
                @if($errors->has('old_password'))
                    <span class="error">{{ $errors->first('old_password') }}</span>
                @endif
            </div>
            <div class="field">
                <input placeholder="{{ trans('language.New-password') }}" type="password" name="password">
                @if($errors->has('password'))
                    <span class="error">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="field">
                <input placeholder="{{ trans('language.New-password-again') }}" type="password" name="password_again">
                @if($errors->has('password_again'))
                    <span class="error">{{ $errors->first('password_again') }}</span>
                @endif
            </div>
            <input type="submit" value="{{ trans('language.Change') }}" class="btn btn-default" style="float: right">
            {{ Form::token() }}
        </form>
    </div>
@stop