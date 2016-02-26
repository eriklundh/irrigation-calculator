@extends('layout.main')

@section('login')
    @include('components.login')
@stop

@section('jumbotron')
<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>IRRIGATION TOOLBOX</h1>
            <p class="justify">
                In most arid and semi-arid regions, agriculture can only be practiced with irrigation. With global population reaching 7 billion and further increasing, pressure from food production has pushed agriculture onto marginal lands and water scarce areas, where fragile soils and ecosystems can easily be impaired by inappropriate irrigation and cultivation techniques. It is therefore important to have tools, which can account for the delicate water balance in these regions so that agriculture can be developed in a sustainable way.
            </p>
        </div>
    </div>
@stop

@section('container')
    <div class="container">
<!-- Example row of columns-->
        <div class="row">
            <div class="col-md-12">
                <h3>Using the toolbox:</h3>
                <p class="justify">
                    The hydrosolutions Irrigation Toolbox combines physical irrigation demand modeling and yield models  (based on FAO standards) with loss calculations of irrigation water in channels and on the field. It uses freely available weather data from ground stations (WMO) as well as satellite data (ECMWF, NCEP) of climate until one day prior to modeling as well as forecast data (GFS). The user can however also provide own weather data. A detailed description of the model can be found in the <a href="{{ URL::route('about') }}">ABOUT</a> section.
                </p>
                <p class="justify">
                    A number of input files are necessary to be able to run the model for your specific location. The format and names of these input files must not be changed except if stated otherwise. These files can be downloaded below, edited and stored on your local device. When starting the model you will be asked to upload each file individually.
                </p>
                <p class="justify">
                    Please familiarize yourself with the model (in the <a href="{{ URL::route('about') }}">About</a> section) and the format of the input files (in the <a href="{{ URL::route('templates') }}">Templates</a> section).
                </p>
            </div>
        </div>
        <div class="row">
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
            <div class="col-md-4">
<!--                <h2>Heading</h2>-->
<!--                <p>Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info. Some info. Some info. Some info. Som info.</p>-->
<!--                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
            </div>
        </div>

        <hr>

        <footer>
            <p>&copy; Hydrosolutions 2015-2016</p>
        </footer>
    </div> <!-- /container -->
@stop