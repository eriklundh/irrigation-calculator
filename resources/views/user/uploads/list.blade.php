@extends('layout.main')

@if($user_role_name=='USER')

    @section('container')
        <div class="container">
            <h2 class="sub-header">Upload</h2>


            <div class="table-responsive">
                <form action='{{ URL::route("user-uploads-upload") }}' method='post' enctype="multipart/form-data">
                    <table>
                        <tbody>
                        <tr>
                            <td><span>Crop :</span></td>
                            <td><input type="file" name="crop"></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span>Soil :</span></td>
                            <td><input type="file" name="soil"></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span>Efficiency :</span></td>
                            <td><input type="file" name="efficiency"></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span>Yield :</span></td>
                            <td><input type="file" name="yield"></td>
                            <td><button class="btn btn-info btn-sm" type="submit">Upload</button></td>
                        </tr>
                        <tr>
                            <td><span>Climate Model :</span></td>
                            <td>
                                <select name="climate_model" class="form-control" style="width:190px">
                                    <option value="Choose">Choose</option>
                                    @foreach($climateModels as $cm)
                                        <option value="{{ $cm }}">{{ $cm }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span>Weather Data :</span></td>
                            <td><input type="file" name="weather_data"></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span>Model :</span></td>
                            <td>
                                <select name="model" class="form-control" style="width:190px">
                                    <option value="Choose">Choose</option>
                                    @foreach($models as $m)
                                        <option value="{{ $m }}">{{ $m }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span>KML :</span></td>
                            <td><input type="file" name="kml"></td>
                            <td>&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>
            </div>

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
            </div>


<!--            <form action='{{-- URL::route("scheme-water-account-upload") --}}' method='post' class="form-inline">-->
<!--                <div class="form-group">-->
<!--                    <label for="crop">Crop:</label>-->
<!--                    <input type="file" class="form-control" id="crop">-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="soil">Soil:</label>-->
<!--                    <input type="file" class="form-control" id="soil">-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="efficiency">Efficiency:</label>-->
<!--                    <input type="file" class="form-control" id="efficiency">-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="kml">KML:</label>-->
<!--                    <input type="file" class="form-control" id="kml">-->
<!--                </div>-->
<!--                <button class="btn btn-info btn-sm" type="submit">Upload</button>-->
<!--                <input type="hidden" name="_token" value="--><?php //echo csrf_token(); ?><!--">-->
<!--            </form>-->

            {{-- Form::open(array('route' => '', 'files' => true)) --}}
            {{-- Form::file('file', array('style'=>'width:200px;line-height: 5px')) --}}
            {{-- Form::submit(trans('language.Upload'), array('class'=>'btn btn-info btn-small', 'style'=>'margin-bottom:5px;margin-right:10px')) --}}
            {{-- Form::close() --}}
        </div>
    @stop

@else

    @include('errors.access-denied')

@endif

