<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Functions extends Model {

    // defines the difference in years, months, days, hours, minutes between two dates
    public static function getDateTimeDifferences($start, $end) {
        $diff = strtotime($end) - strtotime($start);
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
        $seconds = floor($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60);
        return array('years'=>$years, 'months'=>$months, 'days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$seconds);
    }

}
