<?php

class Logging {

    public static function created($object, $arr) {
        Log::info("'".Auth::user()->username."' CREATED ".$object.": ".http_build_query($arr, '', ', '));
    }
    public static function not_created($object, $arr) {
        Log::info("'".Auth::user()->username."' NOT CREATED ".$object.": ".http_build_query($arr, '', ', '));
    }

    public static function edited($object, $arr) {
        Log::info("'".Auth::user()->username."' EDITED ".$object.": ".http_build_query($arr, '', ', '));
    }
    public static function not_edited($object, $arr) {
        Log::info("'".Auth::user()->username."' NOT EDITED ".$object.": ".http_build_query($arr, '', ', '));
    }

    public static function deleted($object, $arr) {
        Log::info("'".Auth::user()->username."' DELETED ".$object.": ".http_build_query($arr, '', ', '));
    }
    public static function not_deleted($object, $arr) {
        Log::info("'".Auth::user()->username."' NOT DELETED ".$object.": ".http_build_query($arr, '', ', '));
    }

    public static function excel_exported($message) {
        Log::info("'".Auth::user()->username."' exported EXCEL for: ".$message);
    }
    public static function word_exported($message) {
        Log::info("'".Auth::user()->username."' exported WORD for: ".$message);
    }

    public static function sensor_discharge_inserted($object, $arr) {
        Log::info($object." inserted: ".http_build_query($arr, '', ', '));
    }
    public static function sensor_discharge_not_inserted($object, $arr) {
        Log::info($object." NOT inserted: ".http_build_query($arr, '', ', '));
    }
    public static function sensor_discharge_local_id_not_exists($message) {
        Log::error($message);
    }

    public static function sign_in_success() {
        Log::info("'".Auth::user()->username."' has successfully signed into the system");
    }
    public static function sign_in_fail($username) {
        Log::info("'".$username."' has TRIED to sign in, but it failed");
    }
    public static function sign_out($username) {
        if(Auth::check())
            Log::info("'".$username."' has TRIED to sign out, but it failed");
        else
            Log::info("'".$username."' has successfully signed out");
    }
    public static function change_password_success() {
        Log::info("'".Auth::user()->username."' has changed password successfully");
    }
    public static function change_password_fail() {
        Log::info("'".Auth::user()->username."' has TRIED to change password, but it failed");
    }
    public static function password_recovery_email_sent_success($email) {
        Log::info("The password recovery email has been successfully sent to the user with email '".$email."'");
    }
    public static function password_recovery_email_sent_fail($email) {
        Log::info("The password recovery email can NOT be sent to the user with email '".$email."'");
    }

}
