<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {
    protected $fillable = array('userId', 'crop', 'soil', 'efficiency', 'yield', 'climate_model', 'weather_data', 'model', 'kml', 'output',
        'state', 'crop_at', 'soil_at', 'efficiency_at', 'yield_at', 'climate_model_at', 'weather_data_at', 'model_at', 'kml_at', 'output_at');

    public static function getModels() {
        return array('Spatial Data'=>'Spatial Data', 'Tabular Data'=>'Tabular Data');
    }

    public static function getClimateModels() {
        return array('SatelliteRaw'=>'SatelliteRaw', 'StationRaw'=>'StationRaw', 'SatelliteBiasCorrected'=>'SatelliteBiasCorrected', 'SelfSuppliedStation'=>'SelfSuppliedStation', 'ClimChange'=>'ClimChange');
    }

    public static function getAllUploads() {
        return Upload::all();
    }

    public static function getUploads() {
        $user_id = User::getSignedInUserId();
        return Upload::where('userId','=',$user_id)->get();
    }
    public static function getUploadsFromUserId($user_id) {
        return Upload::where('userId','=',$user_id)->get();
    }

}
