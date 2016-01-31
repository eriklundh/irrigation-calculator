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
                <h3>Templates</h3>
                <ul>
                    <li>Crop:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/crops.xlsx' }}" target="_blank">crops.xlsx</a></li>
                    <li>Soil:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/soils.xlsx' }}" target="_blank">soils.xlsx</a></li>
                    <li>Efficiency:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/efficiency.xlsx' }}" target="_blank">efficiency.xlsx</a></li>
                    <li>Yield:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/yield.xlsx' }}" target="_blank">yield.xlsx</a></li>
                    <li>Weather Data:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/WeatherData.xlsx' }}" target="_blank">WeatherData.xlsx</a></li>
                    <li>KML:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/IC_Template.kml' }}" target="_blank">IC_Template.kml</a></li>
                </ul>
<!--                <h2>Heading</h2>-->
<!--                <p>Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info.</p>-->
<!--                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
            </div>
            <div class="col-md-4">
                <h3>Upload</h3>
                <ul>
                    <li>Link to upload: <a href="{{ URL::route('user-uploads-list') }}">Uploads</a></li>
                </ul>
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