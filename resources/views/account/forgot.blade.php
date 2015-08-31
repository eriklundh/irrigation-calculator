@extends('layout.main')

@section('container')
    <div id="forgot-password-page">
        <h1 class="title">{{ trans('language.Recover-the-password') }}</h1>
        <form action="{{ URL::route('account-forgot-password-post') }}" method="post">
            <div class="field" style="float: left">
                <input placeholder="email" type="text" name="email"{{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }}>
            </div>
            <input type="submit" value="{{ trans('language.Recover') }}" class="btn btn-default" style="float: left; margin-left: 10px;">
            <div class="error" style="clear:both">
                @if($errors->has('email'))
                    {{ $errors->first('email') }}
                @endif
            </div>
            {{ Form::token() }}
        </form>
    </div>
@stop
