@extends('layout.main')

@if($user_role_name=='USER')

    @section('container')
        <div class="container">
            <?php $now = date("Y-m-d H:i:s"); ?>
            @if($errors->has('minLat'))
                <div style="text-align: center; color: red; position: relative; top: 20px">{{ $errors->first('minLat') }}</div>
            @elseif($errors->has('minLng'))
                <div style="text-align: center; color: red; position: relative; top: 20px">{{ $errors->first('minLng') }}</div>
            @elseif($errors->has('maxLat'))
                <div style="text-align: center; color: red; position: relative; top: 20px">{{ $errors->first('maxLat') }}</div>
            @elseif($errors->has('maxLng'))
                <div style="text-align: center; color: red; position: relative; top: 20px">{{ $errors->first('maxLng') }}</div>
            @endif
            <h2 class="sub-header">Climate Data</h2>
            <span class="bold">File:</span>
            <a href="{{ env('PUBLIC_ROOT').'/uploads/'.$upload->userId.'$'.$upload->climate_data }}" target="_blank">
                {{ $upload->climate_data }}
            </a>
            <span class="bold">Upload Time:</span>
            <?php $diff = App\Functions::getDateTimeDifferences($upload->climate_data_at, $now); ?>
            @if(strtotime($upload->climate_data_at)==0)
            @elseif($diff['years']>0 || $diff['months']>0)
                {{ date('F j, Y', strtotime($upload->climate_data_at)) }}
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
            {{ $state[9] }}
            <h5 style="position: relative; top: 13px">Choose between coordinates and kml file:</h5>
            <form action='{{ URL::route("user-uploads-upload") }}' method='post' enctype="multipart/form-data">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label class="btn">
                                <input type="radio" name="climate_data_radio" value="Coordinates">Coordinates
                            </label>
                            <label class="btn">
                                <input type="radio" name="climate_data_radio" value="KML">KML
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="climate_data_coordinates" style="display: none;">
                                <table>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align="center">Max Lat&nbsp;<input type="text" name="maxLat" size="4"></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;Min Lng<br><input type="text" name="minLng" size="4"></td>
                                        <td>
                                            <div style="border:1px solid black; padding: 60px; margin: 5px; width: 220px"></div>
                                        </td>
                                        <td>&nbsp;Max Lng<br><input type="text" name="maxLng" size="4"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align="center">Min Lat&nbsp;<input type="text" name="minLat" size="4"></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <div id="climate_data_kml" style="display: none;">
                                <input type="file" name="climate_data" class="filestyle" data-input="true" data-icon="false" data-size="sm" data-buttonText="Choose">
                            </div>
                        </td>
                        <td>
                            <div id="climate_data_submit" style="display: none;">
                                <button class="btn btn-info btn-sm" type="submit">Upload</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        </div>
    @stop

@else

    @include('errors.access-denied')

@endif

