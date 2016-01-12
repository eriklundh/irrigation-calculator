@extends('layout.main')

@section('login')
    @include('components.login')
@stop

@section('jumbotron')
<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Irrigation Calculator!</h1>
            <p>This is online irrigation calculator that calculates the water volume given a crop type, soil type and other agro climate parameters.</p>
        </div>
    </div>
@stop

@section('container')
    <div class="container">
<!-- Example row of columns-->
        <div class="row">
            <div class="col-md-4">
                <br><br><br><br><br><br>
<!--                <h2>Heading</h2>-->
<!--                <p>Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info.</p>-->
<!--                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
            </div>
            <div class="col-md-4">
<!--                <h2>Heading</h2>-->
<!--                <p>Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info.</p>-->
<!--                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
            </div>
            <div class="col-md-4">
<!--                <h2>Heading</h2>-->
<!--                <p>Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info.</p>-->
<!--                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
            </div>
        </div>

<!--        <hr>-->

        <footer>
            <p>&copy; Hydrosolutions 2015</p>
        </footer>
    </div> <!-- /container -->
@stop