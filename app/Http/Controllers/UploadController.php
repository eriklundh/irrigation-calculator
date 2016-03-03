<?php

namespace App\Http\Controllers;

use App\Role;
use App\Upload;
use App\User;
use App\Functions;
use Validator;
use Illuminate\Http\Request;
use Auth;

class UploadController extends Controller {

    // uploads' list page
    public function getList() {
        if(Auth::guest())
            return redirect()->route('account-sign-in');
        $user_role_name = User::getUserRoleName();
        $models = Upload::getModels();
        $climateModels = Upload::getClimateModels();
        $uploads = Upload::getUploads();
        $upload = $uploads->first();
        $state_arr = explode('-', $upload->state);
        $state = array();
        for($i=0; $i<8; $i++)
            if($state_arr[$i]==0)
                $state[$i] = 'Not Uploaded';
            else if($state_arr[$i]==1)
                $state[$i] = 'Uploaded';
            else if($state_arr[$i]==2)
                $state[$i] = 'Ready for processing';
        //if($state_arr[8]==0)
        //    $state[8] = 'Not Ready';
        //else if($state_arr[8]==2)
        //    $state[8] = 'Ready';

        // Read from the file
        //$file = fopen(env('PUBLIC_ROOT').'/output/'.$upload->userId.'$'.'OverviewTable.txt', 'r+') or exit("Unable to open OverviewTable.txt file!");
        //$file = fopen('output/'.$upload->userId.'$'.'OverviewTable.txt', 'r+') or exit("Unable to open OverviewTable.txt file!");
        $file=false;
        try {
            $file = fopen('zip://'.env('PUBLIC_ROOT').'/output/'.$upload->userId.'$'.$upload->output.'#OverviewTable.txt', 'r') or exit("Unable to open OverviewTable.txt file!");
            //$file = fopen('zip://C:/xampp/htdocs/ic.com/public/output/'.$upload->userId.'$'.$upload->output.'#OverviewTable.txt', 'r') or exit("Unable to open OverviewTable.txt file!");
        }
        catch(\Exception $e) {
        }
        $overview_table = array();
        if($file) {
            while (!feof($file)) {
                $line = fgets($file);
                $temp_arr = explode(',', $line);
                array_push($overview_table, $temp_arr);
            }
            fclose($file);
        }

        return view('user.uploads.list', compact('user_role_name'), compact('models'))
                ->with(compact('climateModels'))
                ->with(compact('uploads'))
                ->with(compact('upload'))
                ->with(compact('state_arr'))
                ->with(compact('state'))
                ->with(compact('overview_table'));
    }

    // upload from the web site
    public function upload(Request $request) {
        $uploads = Upload::getUploads();
        $upload = $uploads->first();
        $pre_state = $upload->state;
        $pre_state_arr = explode('-', $pre_state);
        $destinationPath = 'uploads/';
        if($request->file('crop')) {
            $file = $request->file('crop');
            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            if($file->getClientOriginalName()!='crops.xlsx')
                return  redirect()->route('user-uploads-list')
                        ->with('global', 'The crop file name should be "crops.xlsx". Please try again!');
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->crop = $file->getClientOriginalName();
                $upload->crop_at = date('Y-m-d H:i:s');
                $pre_state_arr[0]=1;

                $state = $pre_state_arr[0];
                for($i=1; $i<count($pre_state_arr); $i++)
                    $state .= '-'.$pre_state_arr[$i];
                $upload->state = $state;
                $upload->save();
            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The crop file cannot be uploaded. Please try again!');
            }
            return  redirect()->route('user-uploads-list')
                    ->with('global', 'The crop file has been successfully uploaded!');
        }
        if($request->file('soil')) {
            $file = $request->file('soil');
            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            if($file->getClientOriginalName()!='soils.xlsx')
                return  redirect()->route('user-uploads-list')
                        ->with('global', 'The soil file name should be "soils.xlsx". Please try again!');
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->soil = $file->getClientOriginalName();
                $upload->soil_at = date('Y-m-d H:i:s');
                $pre_state_arr[1]=1;

                $state = $pre_state_arr[0];
                for($i=1; $i<count($pre_state_arr); $i++)
                    $state .= '-'.$pre_state_arr[$i];
                $upload->state = $state;
                $upload->save();
            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The soil file cannot be uploaded. Please try again!');
            }
            return  redirect()->route('user-uploads-list')
                    ->with('global', 'The soil file has been successfully uploaded!');
        }
        if($request->file('efficiency')) {
            $file = $request->file('efficiency');
            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            if($file->getClientOriginalName()!='efficiency.xlsx')
                return  redirect()->route('user-uploads-list')
                        ->with('global', 'The efficiency file name should be "efficiency.xlsx". Please try again!');
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->efficiency = $file->getClientOriginalName();
                $upload->efficiency_at = date('Y-m-d H:i:s');
                $pre_state_arr[2]=1;

                $state = $pre_state_arr[0];
                for($i=1; $i<count($pre_state_arr); $i++)
                    $state .= '-'.$pre_state_arr[$i];
                $upload->state = $state;
                $upload->save();
            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The irrigation efficiency file cannot be uploaded. Please try again!');
            }
            return  redirect()->route('user-uploads-list')
                    ->with('global', 'The irrigation efficiency file has been successfully uploaded!');
        }
        if($request->file('yield')) {
            $file = $request->file('yield');
            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            if($file->getClientOriginalName()!='yield.xlsx')
                return  redirect()->route('user-uploads-list')
                        ->with('global', 'The yield file name should be "yield.xlsx". Please try again!');
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->yield = $file->getClientOriginalName();
                $upload->yield_at = date('Y-m-d H:i:s');
                $pre_state_arr[3]=1;

                $state = $pre_state_arr[0];
                for($i=1; $i<count($pre_state_arr); $i++)
                    $state .= '-'.$pre_state_arr[$i];
                $upload->state = $state;
                $upload->save();
            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The crop yield file cannot be uploaded. Please try again!');
            }
            return  redirect()->route('user-uploads-list')
                    ->with('global', 'The crop yield file has been successfully uploaded!');
        }
        if($request->get('climate_model')!='') { // && $request->file('weather_data')) {
            if($request->get('climate_model')=='SelfSuppliedStation')
                $file = $request->file('weather_data');
            if($request->get('climate_model')=='SelfSuppliedStation' && $file->getClientOriginalName()!='WeatherData.xlsx')
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The weather data file name should be "WeatherData.xlsx". Please try again!');

            $file1 = fopen("uploads/".User::getSignedInUserId()."$"."IC_ClimIn.txt", "w+") or exit("Unable to open txt file!");
            $climateModels = Upload::getClimateModels();
            $climate_model_value = '';
            foreach($climateModels as $cm)
                if($cm==$request->get('climate_model')) {
                    fwrite($file1, $cm."\t\t1\n");
                    $climate_model_value = $cm;
                }
                else
                    fwrite($file1, $cm."\t\t0\n");
            fclose($file1);
            $uploads = Upload::getUploads();
            $upload = $uploads->first();
            $upload->climate_model = $climate_model_value;
            $upload->climate_model_at = date('Y-m-d H:i:s');
            $pre_state_arr[4]=1;

            $state = $pre_state_arr[0];
            for($i=1; $i<count($pre_state_arr); $i++)
                $state .= '-'.$pre_state_arr[$i];
            $upload->state = $state;
            $upload->save();

            if($request->get('climate_model')=='SelfSuppliedStation') {
                $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                if( $upload_success ) {
                    $uploads = Upload::getUploads();
                    $upload = $uploads->first();
                    $upload->weather_data = $file->getClientOriginalName();
                    $upload->weather_data_at = date('Y-m-d H:i:s');
                    $pre_state_arr[5]=1;

                    $state = $pre_state_arr[0];
                    for($i=1; $i<count($pre_state_arr); $i++)
                        $state .= '-'.$pre_state_arr[$i];
                    $upload->state = $state;
                    $upload->save();
                } else {
                    return  redirect()->route('user-uploads-list')
                        ->with('global', 'The weather data file cannot be uploaded. Please try again!');
                }
            }
            return  redirect()->route('user-uploads-list')
                    ->with('global', 'Climate Model has been successfully uploaded!');
        }
        if($request->get('model')!='' && $request->file('kml')) {
            $file = $request->file('kml');
            if($request->get('model')=='Spatial Data') {
                if(substr($file->getClientOriginalName(), -4)!='.kml')
                    return  redirect()->route('user-uploads-list')
                        ->with('global', 'The file has to be ".kml" file. Please try again!');
            }
            else if($request->get('model')=='Tabular Data') {
                if(substr($file->getClientOriginalName(), -5)!='.xlsx')
                    return  redirect()->route('user-uploads-list')
                        ->with('global', 'The Field Data has to be provided in ".xlsx" Format.');
            }

            $file1 = fopen("uploads/".User::getSignedInUserId()."$"."ModelType.txt", "w+") or exit("Unable to open txt file!");
            $models = Upload::getModels();
            $model_value = '';
            foreach($models as $m)
                if($m==$request->get('model')) {
                    fwrite($file1, $m."\t\t1\n");
                    $model_value = $m;
                }
                else
                    fwrite($file1, $m."\t\t0\n");
            fclose($file1);

            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->model = $model_value;
                $upload->model_at = date('Y-m-d H:i:s');
                $upload->kml = $file->getClientOriginalName();
                $upload->kml_at = date('Y-m-d H:i:s');
                $upload->output = '';
                $upload->output_at = '';
                $pre_state_arr[6]=1;
                $pre_state_arr[7]=1;
                $pre_state_arr[8]=0;

                $state = $pre_state_arr[0];
                for($i=1; $i<count($pre_state_arr); $i++)
                    $state .= '-'.$pre_state_arr[$i];
                $upload->state = $state;
                $upload->save();

            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The kml file cannot be uploaded. Please try again!');
            }
            return  redirect()->route('user-uploads-list')
                    ->with('global', 'Model Type has been successfully uploaded!');
        }

        /*
        $state = $pre_state_arr[0];
        for($i=1; $i<count($pre_state_arr); $i++)
            $state .= '-'.$pre_state_arr[$i];

        $uploads = Upload::getUploads();
        $upload = $uploads->first();
        $upload->state = $state;
        $upload->save();*/

        //Logging::created('Water Level', array($upload_successful_for_the_last_two_weeks));
        return  redirect()->route('user-uploads-list')->with('global', '');//$upload_successful_for_the_last_two_weeks);
    }

    // returns the number of files that should be downloaded to hydrosolutions server
    public function downloadFileCount() {
        $uploads = Upload::getAllUploads();
        $count = 0;
        foreach($uploads as $u) {
            $state_arr = explode('-',$u->state);
            for($i=0; $i<count($state_arr)-1; $i++)
                if($i==7) {
                    if($state_arr[7]==1 && $state_arr[8]==1) $count++;
                }
                else if($state_arr[$i]==1) $count++;
        }
        return $count;
    }
    // returns the first file name that should be downloaded to hydrosolutions server
    public function downloadFile() {
        $uploads = Upload::getAllUploads();
        foreach($uploads as $u) {
            $state_arr = explode('-',$u->state);
            for($i=0; $i<count($state_arr)-1; $i++)
                if($state_arr[$i]==1) {
                    if($i==7) {
                        if($state_arr[8]==1){
                        }
                        else continue;
                    }
                    $state_arr[$i]=2;
                    $state = $state_arr[0];
                    for($j=1; $j<count($state_arr); $j++)
                        $state .= '-'.$state_arr[$j];
                    $u->state = $state;
                    $u->save();
                    switch ($i) {
                        case 0: return $u->userId.'$'.$u->crop; break;
                        case 1: return $u->userId.'$'.$u->soil; break;
                        case 2: return $u->userId.'$'.$u->efficiency; break;
                        case 3: return $u->userId.'$'.$u->yield; break;
                        case 4: return $u->userId.'$IC_ClimIn.txt'; break;
                        case 5: return $u->userId.'$'.$u->weather_data; break;
                        case 6: return $u->userId.'$ModelType.txt'; break;
                        case 7: return $u->userId.'$'.$u->kml; break;
                    }
                }
        }
    }
    // receives the output file from hydrosolutions server
    public function getOutput(Request $request) {
        $destinationPath = 'output/';
        $user_id = $request->get('user_id');
        if($request->file('file')) {
            $file = $request->file('file');
            $filename = $user_id.'$'.$file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploadsFromUserId($user_id);
                $upload = $uploads->first();
                $pre_state = $upload->state;
                $pre_state_arr = explode('-', $pre_state);
                $pre_state_arr[8]=2;
                $upload->output = $file->getClientOriginalName();
                $upload->output_at = date('Y-m-d H:i:s');
                $state = $pre_state_arr[0];
                for($i=1; $i<count($pre_state_arr); $i++)
                    $state .= '-'.$pre_state_arr[$i];
                $upload->state = $state;
                $upload->save();
            }
        }
    }

    // check whether output is ready or not
    public function checkOutput() {
        $uploads = Upload::getUploads();
        $upload = $uploads->first();
        $state_arr = explode('-', $upload->state);
        $ready = false;
        if($state_arr[8]==2) $ready = true;
        $result = array('ready'=>$ready);
        return json_encode($result);
    }

    // run the model from web browser
    public function runModel() {
        $uploads = Upload::getUploads();
        $upload = $uploads->first();
        $state_arr = explode('-', $upload->state);
        for($i=0; $i<=7; $i++) {
            if($i==5) continue;
            else if($state_arr[$i]==0) {
                switch ($i) {
                    case 0: return json_encode(array('type'=>'Crop', 'state'=>$state_arr[$i])); break;
                    case 1: return json_encode(array('type'=>'Soil', 'state'=>$state_arr[$i])); break;
                    case 2: return json_encode(array('type'=>'Irrigation Efficiency', 'state'=>$state_arr[$i])); break;
                    case 3: return json_encode(array('type'=>'Crop Yield', 'state'=>$state_arr[$i])); break;
                    case 4: return json_encode(array('type'=>'Climate Model', 'state'=>$state_arr[$i])); break;
                    case 5: return json_encode(array('type'=>'Weather Data', 'state'=>$state_arr[$i])); break;
                    case 6: return json_encode(array('type'=>'Model Type', 'state'=>$state_arr[$i])); break;
                    case 7: return json_encode(array('type'=>'Model Type', 'state'=>$state_arr[$i])); break;
                }
            }
        }
        for($i=0; $i<=6; $i++) {
            if($i==5 && $upload->climate_model=='SelfSuppliedStation') continue;
            else if($state_arr[$i]==1) {
                switch ($i) {
                    case 0: return json_encode(array('type'=>'Crop', 'state'=>$state_arr[$i])); break;
                    case 1: return json_encode(array('type'=>'Soil', 'state'=>$state_arr[$i])); break;
                    case 2: return json_encode(array('type'=>'Irrigation Efficiency', 'state'=>$state_arr[$i])); break;
                    case 3: return json_encode(array('type'=>'Crop Yield', 'state'=>$state_arr[$i])); break;
                    case 4: return json_encode(array('type'=>'Climate Model', 'state'=>$state_arr[$i])); break;
                    case 5: return json_encode(array('type'=>'Weather Data', 'state'=>$state_arr[$i])); break;
                    case 6: return json_encode(array('type'=>'Model Type', 'state'=>$state_arr[$i])); break;
                    //case 7: return json_encode(array('type'=>'Model Type', 'state'=>$state_arr[$i])); break;
                }
            }
        }
        $state_arr[8]=1;
        $state = $state_arr[0];
        for($j=1; $j<count($state_arr); $j++)
            $state .= '-'.$state_arr[$j];
        $upload->state = $state;
        $upload->save();
        return json_encode(array('state'=>-1));
    }

}
