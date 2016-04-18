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
        return array('SatelliteRaw'=>'SatelliteRaw', 'StationRaw'=>'StationRaw', 'SelfSuppliedStation'=>'SelfSuppliedStation');
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

    public static function uploadInputFile($file_name_with_full_path, $type, $user_id) {
        $url = Config::getHSURL();
        $post = array(
            'file' => new \CURLFile($file_name_with_full_path), 'user_id' => $user_id,
            'key' => Config::getKey(), 'type' => $type
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $result = curl_exec($ch);
        if(curl_errno($ch)){
            $result = 'Curl error: ' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }

}
