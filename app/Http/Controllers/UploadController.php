<?php

namespace App\Http\Controllers;

use App\Role;
use App\Upload;
use App\User;
use Validator;
use Illuminate\Http\Request;

class UploadController extends Controller {

    public function getList() {
        $user_role_name = User::getUserRoleName();
        $models = Upload::getModels();
        $uploads = Upload::getUploads();
        $upload = $uploads->first();
        $state_arr = explode('-', $upload->state);
        return view('user.uploads.list', compact('user_role_name'), compact('models'))
                ->with(compact('uploads'))
                ->with(compact('state_arr'));
    }

    // receives all uploads of the user
    public function upload(Request $request) {
        $uploads = Upload::getUploads();
        $upload = $uploads->first();
        $pre_state = $upload->state;
        $pre_state_arr = explode('-', $pre_state);
        $destinationPath = 'uploads/';
        if($request->file('crop')) {
            $file = $request->file('crop');
            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->crop = $file->getClientOriginalName();
                $upload->crop_at = date('Y-m-d H:i:s');
                $upload->save();
                $pre_state_arr[0]=1;
            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The crop file cannot be uploaded. Please try again!');
            }
        }
        if($request->file('soil')) {
            $file = $request->file('soil');
            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->soil = $file->getClientOriginalName();
                $upload->soil_at = date('Y-m-d H:i:s');
                $upload->save();
                $pre_state_arr[1]=1;
            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The soil file cannot be uploaded. Please try again!');
            }
        }
        if($request->file('efficiency')) {
            $file = $request->file('efficiency');
            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->efficiency = $file->getClientOriginalName();
                $upload->efficiency_at = date('Y-m-d H:i:s');
                $upload->save();
                $pre_state_arr[2]=1;
            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The efficiency file cannot be uploaded. Please try again!');
            }
        }
        if($request->get('model')!='Choose') {
            $file = fopen("uploads/".User::getSignedInUserId()."_"."IC-ClimIn.txt", "w+") or exit("Unable to open txt file!");
            $models = Upload::getModels();
            foreach($models as $m)
                if($m==$request->get('model'))
                    fwrite($file, $m."\t\t1");
                else
                    fwrite($file, $m."\t\t0");
            fclose($file);
            $uploads = Upload::getUploads();
            $upload = $uploads->first();
            $upload->model = 'IC-ClimIn.txt';
            $upload->model_at = date('Y-m-d H:i:s');
            $upload->save();
            $pre_state_arr[3]=1;
        }
        if($request->file('kml')) {
            $file = $request->file('kml');
            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->kml = $file->getClientOriginalName();
                $upload->kml_at = date('Y-m-d H:i:s');
                $upload->output = '';
                $upload->output_at = '';
                $upload->save();
                $pre_state_arr[4]=1;
                $pre_state_arr[7]=0;

            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The kml file cannot be uploaded. Please try again!');
            }
        }
        if($request->file('channelConnex')) {
            $file = $request->file('channelConnex');
            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->channelConnex = $file->getClientOriginalName();
                $upload->channelConnex_at = date('Y-m-d H:i:s');
                $upload->save();
                $pre_state_arr[5]=1;
            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The channel connex file cannot be uploaded. Please try again!');
            }
        }
        if($request->file('connectivity')) {
            $file = $request->file('connectivity');
            $filename = User::getSignedInUserId().'$'.$file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            if( $upload_success ) {
                $uploads = Upload::getUploads();
                $upload = $uploads->first();
                $upload->connectivity = $file->getClientOriginalName();
                $upload->connectivity_at = date('Y-m-d H:i:s');
                $upload->save();
                $pre_state_arr[6]=1;
            } else {
                return  redirect()->route('user-uploads-list')
                    ->with('global', 'The connectivity file cannot be uploaded. Please try again!');
            }
        }

        $state = $pre_state_arr[0];
        for($i=1; $i<count($pre_state_arr); $i++)
            $state .= '-'.$pre_state_arr[$i];

        $uploads = Upload::getUploads();
        $upload = $uploads->first();
        $upload->state = $state;
        $upload->save();

        //Logging::created('Water Level', array($upload_successful_for_the_last_two_weeks));
        return  redirect()->route('user-uploads-list')->with('global', '');//$upload_successful_for_the_last_two_weeks);
    }

    // returns the number of files that should be downloaded to hydrosolutions server
    public function downloadFileCount() {
        $uploads = Upload::getAllUploads();
        $count = 0;
        foreach($uploads as $u) {
            $state_arr = explode('-',$u->state);
            for($i=0; $i<count($state_arr); $i++)
                if($state_arr[$i]==1) $count++;
        }
        return $count;
    }
    // returns the first file name that should be downloaded to hydrosolutions server
    public function downloadFile() {
        $uploads = Upload::getAllUploads();
        foreach($uploads as $u) {
            $state_arr = explode('-',$u->state);
            for($i=0; $i<count($state_arr); $i++)
                if($state_arr[$i]==1) {
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
                        case 3: return $u->userId.'$'.$u->model; break;
                        case 4: return $u->userId.'$'.$u->kml; break;
                        case 5: return $u->userId.'$'.$u->channelConnex; break;
                        case 6: return $u->userId.'$'.$u->connectivity; break;
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
                $pre_state_arr[7]=2;
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

}
