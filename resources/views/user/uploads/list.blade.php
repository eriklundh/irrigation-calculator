@extends('layout.main')

@if($user_role_name=='USER')

    @section('container')
        <div class="container">
            <?php $now = date("Y-m-d H:i:s"); ?>
            <h2 class="sub-header">Model Specifications</h2>

            <h3>1. Model Type</h3>
            <p class="justify">
                You can choose to either upload your field data in a .kml file produced in GoogleEarth or a GIS software (ArcGIS, QGis) or listed in tables in an Excel sheet. The data format specifications are described <a href="{{ URL::route('templates') }}">here</a>.
            </p>

            <span class="bold">File:</span>
            <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->kml }}" target="_blank">
                {{ $upload->kml }}
            </a>
            {{ '('.$upload->model.')' }}
            <span class="bold">Upload Time:</span>
            <?php $diff = App\Functions::getDateTimeDifferences($upload->kml_at, $now); ?>
            @if(strtotime($upload->kml_at)==0)
            @elseif($diff['years']>0 || $diff['months']>0)
            {{ date('F j, Y', strtotime($upload->kml_at)) }}
            @elseif($diff['days']>0)
            {{ $diff['days'] }}
            @if($diff['days']==1)
            day ago
            @else
            days ago
            @endif
            @elseif($diff['hours']>0)
            {{ $diff['hours'] }}
            @if($diff['hours']==1)
            hour ago
            @else
            hours ago
            @endif
            @elseif($diff['minutes']>0)
            {{ $diff['minutes'] }}
            @if($diff['minutes']==1)
            minute ago
            @else
            minutes ago
            @endif
            @elseif($diff['seconds']>0)
            {{ $diff['seconds'] }}
            @if($diff['seconds']==1)
            second ago
            @else
            seconds ago
            @endif
            @elseif($diff['seconds']==0)
            Just now
            @endif
            <span class="bold">State:</span>
            {{ $state[7] }}
            <form action='{{ URL::route("user-uploads-upload") }}' method='post' enctype="multipart/form-data">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            @foreach($models as $m)
                            <label class="btn">
                                <input type="radio" name="model" value="{{ $m }}">{{ $m }}
                            </label>
                            @endforeach
                        </td>
                        <td>
                            <div id="kml_div" style="display: none;">
                                <input type="file" name="kml" class="filestyle" data-input="true" data-icon="false" data-size="sm" data-buttonText="Choose">
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" type="submit">Upload</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>

            <h3>2. Crop – Soil – Irrigation Data</h3>
            <p class="justify">
                Input data on crops, soil, irrigation type and loss factors as well as yield factors are necessary. The default values are based on standard literature values and data collected in the field (see <a href="{{ URL::route('about') }}">here</a> for details).
            </p>
            <p class="justify">
                If you wish to edit default values you can do so by uploading your own file by clicking on 'Upload'’. Make sure you use the required format specified in <a href="{{ URL::route('templates') }}">Templates</a>.
            </p>
            <span class="bold">Crop</span>
            <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->crop }}" target="_blank">
                {{ $upload->crop }}
            </a>
            <span class="bold">Upload Time:</span>
            <?php $diff = App\Functions::getDateTimeDifferences($upload->crop_at, $now); ?>
            @if(strtotime($upload->crop_at)==0)
            @elseif($diff['years']>0 || $diff['months']>0)
            {{ date('F j, Y', strtotime($upload->crop_at)) }}
            @elseif($diff['days']>0)
            {{ $diff['days'] }}
            @if($diff['days']==1)
            day ago
            @else
            days ago
            @endif
            @elseif($diff['hours']>0)
            {{ $diff['hours'] }}
            @if($diff['hours']==1)
            hour ago
            @else
            hours ago
            @endif
            @elseif($diff['minutes']>0)
            {{ $diff['minutes'] }}
            @if($diff['minutes']==1)
            minute ago
            @else
            minutes ago
            @endif
            @elseif($diff['seconds']>0)
            {{ $diff['seconds'] }}
            @if($diff['seconds']==1)
            second ago
            @else
            seconds ago
            @endif
            @elseif($diff['seconds']==0)
            Just now
            @endif
            <span class="bold">State:</span>
            {{ $state[0] }}
            <form action='{{ URL::route("user-uploads-upload") }}' method='post' enctype="multipart/form-data">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <input type="file" name="crop" class="filestyle" data-input="true" data-icon="false" data-size="sm" data-buttonText="Choose">
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" type="submit">Upload</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>


            <span class="bold">Soil</span>
            <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->soil }}" target="_blank">
                {{ $upload->soil }}
            </a>
            <span class="bold">Upload Time</span>
            <?php $diff = App\Functions::getDateTimeDifferences($upload->soil_at, $now); ?>
            @if(strtotime($upload->soil_at)==0)
            @elseif($diff['years']>0 || $diff['months']>0)
            {{ date('F j, Y', strtotime($upload->soil_at)) }}
            @elseif($diff['days']>0)
            {{ $diff['days'] }}
            @if($diff['days']==1)
            day ago
            @else
            days ago
            @endif
            @elseif($diff['hours']>0)
            {{ $diff['hours'] }}
            @if($diff['hours']==1)
            hour ago
            @else
            hours ago
            @endif
            @elseif($diff['minutes']>0)
            {{ $diff['minutes'] }}
            @if($diff['minutes']==1)
            minute ago
            @else
            minutes ago
            @endif
            @elseif($diff['seconds']>0)
            {{ $diff['seconds'] }}
            @if($diff['seconds']==1)
            second ago
            @else
            seconds ago
            @endif
            @elseif($diff['seconds']==0)
            Just now
            @endif
            <span class="bold">State</span>
            {{ $state[1] }}
            <form action='{{ URL::route("user-uploads-upload") }}' method='post' enctype="multipart/form-data">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <input type="file" name="soil" class="filestyle" data-input="true" data-icon="false" data-size="sm" data-buttonText="Choose">
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" type="submit">Upload</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>

            <span class="bold">Irrigation Efficiency</span>
            <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->efficiency }}" target="_blank">
                {{ $upload->efficiency }}
            </a>
            <span class="bold">Upload Time</span>
            <?php $diff = App\Functions::getDateTimeDifferences($upload->efficiency_at, $now); ?>
            @if(strtotime($upload->efficiency_at)==0)
            @elseif($diff['years']>0 || $diff['months']>0)
            {{ date('F j, Y', strtotime($upload->efficiency_at)) }}
            @elseif($diff['days']>0)
            {{ $diff['days'] }}
            @if($diff['days']==1)
            day ago
            @else
            days ago
            @endif
            @elseif($diff['hours']>0)
            {{ $diff['hours'] }}
            @if($diff['hours']==1)
            hour ago
            @else
            hours ago
            @endif
            @elseif($diff['minutes']>0)
            {{ $diff['minutes'] }}
            @if($diff['minutes']==1)
            minute ago
            @else
            minutes ago
            @endif
            @elseif($diff['seconds']>0)
            {{ $diff['seconds'] }}
            @if($diff['seconds']==1)
            second ago
            @else
            seconds ago
            @endif
            @elseif($diff['seconds']==0)
            Just now
            @endif
            <span class="bold">State</span>
            {{ $state[2] }}
            <form action='{{ URL::route("user-uploads-upload") }}' method='post' enctype="multipart/form-data">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <input type="file" name="efficiency" class="filestyle" data-input="true" data-icon="false" data-size="sm" data-buttonText="Choose">
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" type="submit">Upload</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>


            <span class="bold">Crop Yield</span>
            <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->yield }}" target="_blank">
                {{ $upload->yield }}
            </a>
            <span class="bold">Upload Time</span>
            <?php $diff = App\Functions::getDateTimeDifferences($upload->yield_at, $now); ?>
            @if(strtotime($upload->yield_at)==0)
            @elseif($diff['years']>0 || $diff['months']>0)
            {{ date('F j, Y', strtotime($upload->yield_at)) }}
            @elseif($diff['days']>0)
            {{ $diff['days'] }}
            @if($diff['days']==1)
            day ago
            @else
            days ago
            @endif
            @elseif($diff['hours']>0)
            {{ $diff['hours'] }}
            @if($diff['hours']==1)
            hour ago
            @else
            hours ago
            @endif
            @elseif($diff['minutes']>0)
            {{ $diff['minutes'] }}
            @if($diff['minutes']==1)
            minute ago
            @else
            minutes ago
            @endif
            @elseif($diff['seconds']>0)
            {{ $diff['seconds'] }}
            @if($diff['seconds']==1)
            second ago
            @else
            seconds ago
            @endif
            @elseif($diff['seconds']==0)
            Just now
            @endif
            <span class="bold">State</span>
            {{ $state[3] }}
            <form action='{{ URL::route("user-uploads-upload") }}' method='post' enctype="multipart/form-data">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <input type="file" name="yield" class="filestyle" data-input="true" data-icon="false" data-size="sm" data-buttonText="Choose">
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" type="submit">Upload</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>



            <h3>3. Climate Data</h3>
            <p class="justify">
                The model can be run with Climate Data from Satellites (‘Satellite Data’), WMO weather stations (‘Station Data’) or self supplied data (‘Self-supplied Data’). A description of the available satellite and weather station data is provided in <a href="{{ URL::route('about') }}">About</a>. Be aware that using the option ‘Station Data’ may cause the model to run considerably longer.
            </p>
            <span class="bold">Model</span>
            @if($upload->climate_model=='SelfSuppliedStation')
                {{ $upload->climate_model }}
                <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->weather_data }}" target="_blank">
                    {{ $upload->weather_data }}
                </a>
            @else
                {{ $upload->climate_model }}
            @endif
            <span class="bold">Upload Time</span>
            @if($upload->climate_model=='SelfSuppliedStation')
                <?php $diff = App\Functions::getDateTimeDifferences($upload->weather_data_at, $now); ?>
                @if(strtotime($upload->weather_data_at)==0)
                @elseif($diff['years']>0 || $diff['months']>0)
                {{ date('F j, Y', strtotime($upload->weather_data_at)) }}
                @elseif($diff['days']>0)
                {{ $diff['days'] }}
                @if($diff['days']==1)
                day ago
                @else
                days ago
                @endif
                @elseif($diff['hours']>0)
                {{ $diff['hours'] }}
                @if($diff['hours']==1)
                hour ago
                @else
                hours ago
                @endif
                @elseif($diff['minutes']>0)
                {{ $diff['minutes'] }}
                @if($diff['minutes']==1)
                minute ago
                @else
                minutes ago
                @endif
                @elseif($diff['seconds']>0)
                {{ $diff['seconds'] }}
                @if($diff['seconds']==1)
                second ago
                @else
                seconds ago
                @endif
                @elseif($diff['seconds']==0)
                Just now
                @endif
            @else
                <?php $diff = App\Functions::getDateTimeDifferences($upload->climate_model_at, $now); ?>
                @if(strtotime($upload->climate_model_at)==0)
                @elseif($diff['years']>0 || $diff['months']>0)
                {{ date('F j, Y', strtotime($upload->climate_model_at)) }}
                @elseif($diff['days']>0)
                {{ $diff['days'] }}
                @if($diff['days']==1)
                day ago
                @else
                days ago
                @endif
                @elseif($diff['hours']>0)
                {{ $diff['hours'] }}
                @if($diff['hours']==1)
                hour ago
                @else
                hours ago
                @endif
                @elseif($diff['minutes']>0)
                {{ $diff['minutes'] }}
                @if($diff['minutes']==1)
                minute ago
                @else
                minutes ago
                @endif
                @elseif($diff['seconds']>0)
                {{ $diff['seconds'] }}
                @if($diff['seconds']==1)
                second ago
                @else
                seconds ago
                @endif
                @elseif($diff['seconds']==0)
                Just now
                @endif
            @endif
            <span class="bold">State</span>
            @if($upload->climate_model=='SelfSuppliedStation')
                {{ $state[5] }}
            @else
                {{ $state[4] }}
            @endif
            <form action='{{ URL::route("user-uploads-upload") }}' method='post' enctype="multipart/form-data">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            @foreach($climateModels as $cm)
                            <label class="btn" style="display: inline">
                                <input type="radio" name="climate_model" value="{{ $cm }}">{{ $cm }}
                            </label>
                            @endforeach
                        </td>
                        <td>
                            <div id="weather_data_div" style="display: none">
                                <input type="file" name="weather_data" class="filestyle" data-input="true" data-icon="false" data-size="sm" data-buttonText="Choose">
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" type="submit">Upload</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>


            <h3>4. Finish Model Setup</h3>
            <p class="justify">
                Make sure you have supplied all files and input above correctly. Once done press ‘Run Model’
            </p>





            <div class="table-responsive">
                <!--
                <form action='{{ URL::route("user-uploads-upload") }}' method='post' enctype="multipart/form-data">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th class="first-column"></th>
                            <th class="file-name center">File Name</th>
                            <th class="choose-file center">New Upload</th>
                            <th class="upload-time center">Upload Time</th>
                            <th class="state center">State</th>
                            <th rowspan="7" class="upload-button center" style="vertical-align: middle"><button class="btn btn-info btn-sm" type="submit">Upload</button></th>
                        </tr>
                        <tr>
                            <td class="bold">Crop</td>
                            <td>
                                <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->crop }}" target="_blank">
                                    {{ $upload->crop }}
                                </a>
                            </td>
                            <td class="center">
                                <input type="file" name="crop" class="filestyle" data-input="false" data-icon="false" data-size="sm" data-buttonText="Choose">
                            </td>
                            <td>
                                <?php $diff = App\Functions::getDateTimeDifferences($upload->crop_at, $now); ?>
                                @if(strtotime($upload->crop_at)==0)
                                @elseif($diff['years']>0 || $diff['months']>0)
                                    {{ date('F j, Y', strtotime($upload->crop_at)) }}
                                @elseif($diff['days']>0)
                                    {{ $diff['days'] }}
                                    @if($diff['days']==1)
                                        day ago
                                    @else
                                        days ago
                                    @endif
                                @elseif($diff['hours']>0)
                                    {{ $diff['hours'] }}
                                    @if($diff['hours']==1)
                                        hour ago
                                    @else
                                        hours ago
                                    @endif
                                @elseif($diff['minutes']>0)
                                    {{ $diff['minutes'] }}
                                    @if($diff['minutes']==1)
                                        minute ago
                                    @else
                                        minutes ago
                                    @endif
                                @elseif($diff['seconds']>0)
                                    {{ $diff['seconds'] }}
                                    @if($diff['seconds']==1)
                                        second ago
                                    @else
                                        seconds ago
                                    @endif
                                @elseif($diff['seconds']==0)
                                    Just now
                                @endif
                            </td>
                            <td class="center">{{ $state[0] }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Soil</td>
                            <td>
                                <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->soil }}" target="_blank">
                                    {{ $upload->soil }}
                                </a>
                            </td>
                            <td><input type="file" name="soil" class="filestyle" data-input="false" data-icon="false" data-size="sm" data-buttonText="Choose"></td>
                            <td>
                                <?php $diff = App\Functions::getDateTimeDifferences($upload->soil_at, $now); ?>
                                @if(strtotime($upload->soil_at)==0)
                                @elseif($diff['years']>0 || $diff['months']>0)
                                    {{ date('F j, Y', strtotime($upload->soil_at)) }}
                                @elseif($diff['days']>0)
                                    {{ $diff['days'] }}
                                    @if($diff['days']==1)
                                        day ago
                                    @else
                                        days ago
                                    @endif
                                @elseif($diff['hours']>0)
                                    {{ $diff['hours'] }}
                                    @if($diff['hours']==1)
                                        hour ago
                                    @else
                                        hours ago
                                    @endif
                                @elseif($diff['minutes']>0)
                                    {{ $diff['minutes'] }}
                                    @if($diff['minutes']==1)
                                        minute ago
                                    @else
                                        minutes ago
                                    @endif
                                @elseif($diff['seconds']>0)
                                    {{ $diff['seconds'] }}
                                    @if($diff['seconds']==1)
                                        second ago
                                    @else
                                        seconds ago
                                    @endif
                                @elseif($diff['seconds']==0)
                                    Just now
                                @endif
                            </td>
                            <td class="center">{{ $state[1] }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Efficiency</td>
                            <td>
                                <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->efficiency }}" target="_blank">
                                    {{ $upload->efficiency }}
                                </a>
                            </td>
                            <td><input type="file" name="efficiency" class="filestyle" data-input="false" data-icon="false" data-size="sm" data-buttonText="Choose"></td>
                            <td>
                                <?php $diff = App\Functions::getDateTimeDifferences($upload->efficiency_at, $now); ?>
                                @if(strtotime($upload->efficiency_at)==0)
                                @elseif($diff['years']>0 || $diff['months']>0)
                                    {{ date('F j, Y', strtotime($upload->efficiency_at)) }}
                                @elseif($diff['days']>0)
                                    {{ $diff['days'] }}
                                    @if($diff['days']==1)
                                        day ago
                                    @else
                                        days ago
                                    @endif
                                @elseif($diff['hours']>0)
                                    {{ $diff['hours'] }}
                                    @if($diff['hours']==1)
                                        hour ago
                                    @else
                                        hours ago
                                    @endif
                                @elseif($diff['minutes']>0)
                                    {{ $diff['minutes'] }}
                                    @if($diff['minutes']==1)
                                        minute ago
                                    @else
                                        minutes ago
                                    @endif
                                @elseif($diff['seconds']>0)
                                    {{ $diff['seconds'] }}
                                    @if($diff['seconds']==1)
                                        second ago
                                    @else
                                        seconds ago
                                    @endif
                                @elseif($diff['seconds']==0)
                                    Just now
                                @endif
                            </td>
                            <td class="center">{{ $state[2] }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Yield</td>
                            <td>
                                <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->yield }}" target="_blank">
                                    {{ $upload->yield }}
                                </a>
                            </td>
                            <td><input type="file" name="yield" class="filestyle" data-input="false" data-icon="false" data-size="sm" data-buttonText="Choose"></td>
                            <td>
                                <?php $diff = App\Functions::getDateTimeDifferences($upload->yield_at, $now); ?>
                                @if(strtotime($upload->yield_at)==0)
                                @elseif($diff['years']>0 || $diff['months']>0)
                                    {{ date('F j, Y', strtotime($upload->yield_at)) }}
                                @elseif($diff['days']>0)
                                    {{ $diff['days'] }}
                                    @if($diff['days']==1)
                                        day ago
                                    @else
                                        days ago
                                    @endif
                                @elseif($diff['hours']>0)
                                    {{ $diff['hours'] }}
                                    @if($diff['hours']==1)
                                        hour ago
                                    @else
                                        hours ago
                                    @endif
                                @elseif($diff['minutes']>0)
                                    {{ $diff['minutes'] }}
                                    @if($diff['minutes']==1)
                                        minute ago
                                    @else
                                        minutes ago
                                    @endif
                                @elseif($diff['seconds']>0)
                                    {{ $diff['seconds'] }}
                                    @if($diff['seconds']==1)
                                        second ago
                                    @else
                                        seconds ago
                                    @endif
                                @elseif($diff['seconds']==0)
                                    Just now
                                @endif
                            </td>
                            <td class="center">{{ $state[3] }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Weather Data</td>
                            <td>
                                {{ $upload->climate_model }}<br>
                                <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->weather_data }}" target="_blank">
                                    {{ $upload->weather_data }}
                                </a>
                            </td>
                            <td>
                                @foreach($climateModels as $cm)
                                    <label class="btn" style="display: inline">
                                        <input type="radio" name="climate_model" value="{{ $cm }}">{{ $cm }} <br>
                                    </label>
                                @endforeach
                                <div id="weather_data_div" style="display: none">
                                    <input type="file" name="weather_data" class="filestyle" data-input="false" data-icon="false" data-size="sm" data-buttonText="Choose">
                                </div>
                            </td>
                            <td>
                                <?php $diff = App\Functions::getDateTimeDifferences($upload->weather_data_at, $now); ?>
                                @if(strtotime($upload->weather_data_at)==0)
                                @elseif($diff['years']>0 || $diff['months']>0)
                                    {{ date('F j, Y', strtotime($upload->weather_data_at)) }}
                                @elseif($diff['days']>0)
                                    {{ $diff['days'] }}
                                    @if($diff['days']==1)
                                        day ago
                                    @else
                                        days ago
                                    @endif
                                @elseif($diff['hours']>0)
                                    {{ $diff['hours'] }}
                                    @if($diff['hours']==1)
                                        hour ago
                                    @else
                                        hours ago
                                    @endif
                                @elseif($diff['minutes']>0)
                                    {{ $diff['minutes'] }}
                                    @if($diff['minutes']==1)
                                        minute ago
                                    @else
                                        minutes ago
                                    @endif
                                @elseif($diff['seconds']>0)
                                    {{ $diff['seconds'] }}
                                    @if($diff['seconds']==1)
                                        second ago
                                    @else
                                        seconds ago
                                    @endif
                                @elseif($diff['seconds']==0)
                                    Just now
                                @endif
                            </td>
                            <td class="center">{{ $state[5] }}</td>
                        </tr>
                        <tr>
                            <td class="bold">KML</td>
                            <td>
                                {{ $upload->model }}<br>
                                <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->kml }}" target="_blank">
                                    {{ $upload->kml }}
                                </a>
                            </td>
                            <td>
                                @foreach($models as $m)
                                    <label class="btn" style="display: inline">
                                        <input type="radio" name="model" value="{{ $m }}">{{ $m }}
                                    </label>
                                @endforeach
                                <div id="kml_div" style="display: none">
                                    <input type="file" name="kml" class="filestyle" data-input="false" data-icon="false" data-size="sm" data-buttonText="Choose">
                                </div>
                            </td>
                            <td>
                                <?php $diff = App\Functions::getDateTimeDifferences($upload->kml_at, $now); ?>
                                @if(strtotime($upload->kml_at)==0)
                                @elseif($diff['years']>0 || $diff['months']>0)
                                    {{ date('F j, Y', strtotime($upload->kml_at)) }}
                                @elseif($diff['days']>0)
                                    {{ $diff['days'] }}
                                    @if($diff['days']==1)
                                        day ago
                                    @else
                                        days ago
                                    @endif
                                @elseif($diff['hours']>0)
                                    {{ $diff['hours'] }}
                                    @if($diff['hours']==1)
                                        hour ago
                                    @else
                                        hours ago
                                    @endif
                                @elseif($diff['minutes']>0)
                                    {{ $diff['minutes'] }}
                                    @if($diff['minutes']==1)
                                        minute ago
                                    @else
                                        minutes ago
                                    @endif
                                @elseif($diff['seconds']>0)
                                    {{ $diff['seconds'] }}
                                    @if($diff['seconds']==1)
                                        second ago
                                    @else
                                        seconds ago
                                    @endif
                                @elseif($diff['seconds']==0)
                                    Just now
                                @endif
                            </td>
                            <td class="center">{{ $state[7] }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>  -->
                <div class="center">
                    <span class="bold">Output: </span>
                    @if($state_arr[8]==0)
                        <a class="btn btn-default btn-sm" onclick="run_model()">Run Model</a>
                    @elseif($state_arr[8]==1)
                        <span style="color:red">
                            Model in process ...
                        </span>
                    @elseif($state_arr[8]==2)
                        <span style="color:red">Ready</span>
                        <a href="{{ env('PUBLIC_ROOT').'/output/'.$upload->userId.'$'.$upload->output }}" target="_blank">{{ $upload->output }}</a>
                        <?php $diff = App\Functions::getDateTimeDifferences($upload->output_at, $now); ?>
                        @if(strtotime($upload->output_at)==0)
                        @elseif($diff['years']>0 || $diff['months']>0)
                            {{ date('F j, Y', strtotime($upload->output_at)) }}
                        @elseif($diff['days']>0)
                            {{ $diff['days'] }}
                            @if($diff['days']==1)
                                day ago
                            @else
                                days ago
                            @endif
                        @elseif($diff['hours']>0)
                            {{ $diff['hours'] }}
                            @if($diff['hours']==1)
                                hour ago
                            @else
                                hours ago
                            @endif
                        @elseif($diff['minutes']>0)
                            {{ $diff['minutes'] }}
                            @if($diff['minutes']==1)
                                minute ago
                            @else
                                minutes ago
                            @endif
                        @elseif($diff['seconds']>0)
                            {{ $diff['seconds'] }}
                            @if($diff['seconds']==1)
                                second ago
                            @else
                                seconds ago
                            @endif
                        @elseif($diff['seconds']==0)
                            Just now
                        @endif
                        <h4>Summary statistics of all fields calculated</h4>
                        <p class="justify" style="text-align: center">
                            Below the mean annual of the water balance are summarized for each field calculated
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                @for($i=0; $i<count($overview_table); $i++)
                                    @if($i==0)
                                        <thead>
                                        <tr>
                                            @for($j=0; $j<count($overview_table[$i]); $j++)
                                                <th>{{ $overview_table[$i][$j].' '.$overview_table[$i+1][$j] }}</th>
                                            @endfor
                                        </tr>
                                        </thead>
                                    @elseif($i>=2)
                                        <tbody>
                                        <tr>
                                            @for($j=0; $j<count($overview_table[$i]); $j++)
                                            <td>{{ $overview_table[$i][$j] }}</td>
                                            @endfor
                                        </tr>
                                        </tbody>
                                    @endif
                                @endfor
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <!--
            <br>
            <div class="table-responsive">
                @if ($uploads->isEmpty())
                    <p>There are no uploads</p>
                @else
                    <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="first-column"></th>
                        <th class="center">Crop</th>
                        <th class="center">Soil</th>
                        <th class="center">Efficiency</th>
                        <th class="center">Yield</th>
                        <th class="center">Climate Model</th>
                        <th class="center">Weather Data</th>
                        <th class="center">Model</th>
                        <th class="center">KML</th>
                        <th class="center">Output</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($uploads as $u)
                    <tr>
                        <td class="bold">File Name:</td>
                        <td class="center">{{ $u->crop }}</td>
                        <td class="center">{{ $u->soil }}</td>
                        <td class="center">{{ $u->efficiency }}</td>
                        <td class="center">{{ $u->yield }}</td>
                        <td class="center">{{ $u->climate_model }}</td>
                        <td class="center">{{ $u->weather_data }}</td>
                        <td class="center">{{ $u->model }}</td>
                        <td class="center">{{ $u->kml }}</td>
                        <td class="center">
                            <a href="{{ env('PUBLIC_ROOT').'/output/'.$u->userId.'$'.$u->output }}" target="_blank">{{ $u->output }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="bold">Upload Time:</td>
                        <td class="center">{{ $u->crop_at }}</td>
                        <td class="center">{{ $u->soil_at }}</td>
                        <td class="center">{{ $u->efficiency_at }}</td>
                        <td class="center">{{ $u->yield_at }}</td>
                        <td class="center">{{ $u->climate_model_at }}</td>
                        <td class="center">{{ $u->weather_data_at }}</td>
                        <td class="center">{{ $u->model_at }}</td>
                        <td class="center">{{ $u->kml_at }}</td>
                        <td class="center">{{ $u->output_at }}</td>
                    </tr>
                    <tr>
                        <td class="bold">State:</td>
                        @for ($i = 0; $i < 8; $i++)
                            <td class="center">
                                @if($state_arr[$i]==0)
                                    Local
                                @elseif($state_arr[$i]==1)
                                    AWS
                                @elseif($state_arr[$i]==2)
                                    HS
                                @endif
                            </td>
                        @endfor
                        <td class="center">
                            @if($state_arr[8]==0)
                                Not Ready
                            @elseif($state_arr[8]==2)
                                <span style="color:red">Ready</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div> -->

            {{-- Form::open(array('route' => '', 'files' => true)) --}}
            {{-- Form::file('file', array('style'=>'width:200px;line-height: 5px')) --}}
            {{-- Form::submit(trans('language.Upload'), array('class'=>'btn btn-info btn-small', 'style'=>'margin-bottom:5px;margin-right:10px')) --}}
            {{-- Form::close() --}}
        </div>
    @stop

@else

    @include('errors.access-denied')

@endif

