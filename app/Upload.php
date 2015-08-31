<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {
    protected $fillable = array('userId', 'crop', 'soil', 'efficiency', 'kml', 'channelConnex', 'connectivity', 'output',
        'state', 'crop_at', 'soil_at', 'efficiency_at', 'kml_at', 'channelConnex_at', 'connectivity_at', 'output_at');

    public static function getModels() {
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
