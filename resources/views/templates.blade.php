@extends('layout.main')

@section('login')
    @include('components.login')
@stop

@section('container')
    <div class="container">
<!-- Example row of columns-->
        <div class="row">
            <div class="col-md-12">
                <h2>Templates of input files:</h2>
                <ul>
                    <li>Crop:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/crops.xlsx' }}" target="_blank">crops.xlsx</a></li>
                </ul>
                <img src="{{ asset('img/crops.png') }}" class="img-responsive" style="width: 80%; height: 80%; margin: 0 auto">
                <br>
                <p class="justify">
                    If you want to add a new crop, add it in the last line and make sure that all necessary fields are filled and provide reasonable estimates where no accurate values are available. When adding a new crop make sure that the same crop is added in the <span style="font-style: italic">Yield</span> table as well. A detailed description of the different columns is given in ABOUT.
                </p>
                <p class="justify">
                    The growth length needs to be provided in days in ‘length of growth stages (d) – TOTAL’. The specific columns before defining different stages are given in fractions of 1.
                </p>
                <ul>
                    <li>Yield:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/yield.xlsx' }}" target="_blank">yield.xlsx</a></li>
                </ul>
                <img src="{{ asset('img/yield.png') }}" class="img-responsive" style="width: 80%; height: 80%; margin: 0 auto">
                <br>
                <p class="justify">
                    Add any new crop at the end of the list. A detailed description of the yield factors is provided in ABOUT. If values are not known fields can be left blank and standard values will be used.
                </p>
                <ul>
                    <li>Soil:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/soils.xlsx' }}" target="_blank">soils.xlsx</a></li>
                </ul>
                <img src="{{ asset('img/soils.png') }}" class="img-responsive" style="width: 50%; height: 50%; margin: 0 auto">
                <br>
                <p class="justify">
                    Any new soil type can be added at the end of the list or old values can be changed according to local knowledge.
                </p>
                <ul>
                    <li>Efficiency:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/efficiency.xlsx' }}" target="_blank">efficiency.xlsx</a></li>
                </ul>
                <img src="{{ asset('img/efficiency1.png') }}" class="img-responsive" style="width: 50%; height: 50%; margin: 0 auto">
                <br>
                <img src="{{ asset('img/efficiency2.png') }}" class="img-responsive" style="width: 50%; height: 50%; margin: 0 auto">
                <br>
                <p class="justify">
                    The efficiency file includes data on channel losses and losses depending on different irrigation types. If you want to make changes ideally contact us beforehand.
                </p>
                <ul>
                    <li>Weather Data:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/WeatherData.xlsx' }}" target="_blank">WeatherData.xlsx</a></li>
                </ul>
                <img src="{{ asset('img/weather_data.png') }}" class="img-responsive" style="width: 60%; height: 60%; margin: 0 auto">
                <br>
                <p class="justify">
                    You can provide your own weather data in the provided format. Make sure that the date is provided in mm/dd/yyyy. You can provide different stations in different tabs.
                </p>

                <ul>
                    <li>KML:&nbsp;&nbsp;&nbsp;<a href="{{ env('PUBLIC_ROOT').'/output/IC_Template.kml' }}" target="_blank">IC_Template.kml</a></li>
                </ul>
                <p class="justify">
                    Make sure that your kml file has the Structure of the template file. Ideally use the template file and add your own fields and channels. You can also add additional Schemes as subfolders.
                </p>
                <p class="justify">
                    You can change the name of the kml file to IC_NAME. Make sure that ‘IC_’ stays in the file name. Then change the name of the folder below accordingly. It has to be the same as the kml name. Do not change the name of the ‘Plots’ and ‘Canals’ folder. You can change the name of the ‘Scheme1’ folder and the individual fields and canals but make sure to have no space in the name.
                </p>
                <img src="{{ asset('img/kml.png') }}" class="img-responsive" style="width: 40%; height: 40%; margin: 0 auto">
                <p class="justify">
                    You can draw the fields as polygons and by clicking on ‘Get Info’ add field information as shown in the image below.
                </p>
                <img src="{{ asset('img/google_earth.png') }}" class="img-responsive" style="width: 70%; height: 70%; margin: 0 auto">
                <br>
                <p class="justify">
                    Please fill them according to your field site and then proceed to <a href="{{ URL::route('user-uploads-list') }}">uploading</a> your data.
                </p>
                <p class="justify">
                    To be able to use the Toolbox please request an account by contacting us at <a href="mailto:steiner@hydrosolutions.ch" target="_top">steiner@hydrosolutions.ch</a>. You will then get all necessary access details for the Upload Section.
                </p>
            </div>
        </div>

        <hr>

        <footer>
            <p>&copy; Hydrosolutions 2015-2016</p>
        </footer>
    </div> <!-- /container -->
@stop