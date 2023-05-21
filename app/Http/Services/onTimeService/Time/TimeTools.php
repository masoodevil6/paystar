<?php
namespace App\Http\Services\onTimeService\Time;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class  TimeTools{

    public static $typeAdd = "add";
    public static $typeSub = "sub";

    public static $millisecond = "millisecond";
    public static $second = "second";
    public static $minute = "minute";
    public static $hour = "hours";
    public static $day = "day";
    public static $month = "month";
    public static $year = "year";


    public static function getListTimeUnit(){
        return Config::get("timeTools.units");
    }




    public static function calculateRequest(Carbon $carbon , $timeUnit , $type , $value = 1){
        if ($timeUnit == self::$millisecond){
            return self::calculateForMillisecondRequest($carbon , $type , $value);
        }
        if ($timeUnit == self::$second){
            return self::calculateForSecondRequest($carbon , $type , $value);
        }
        else if ($timeUnit == self::$minute){
            return self::calculateForMinuteRequest($carbon , $type , $value);
        }
        else if ($timeUnit == self::$hour){
            return self::calculateForHourRequest($carbon , $type , $value);
        }
        else if ($timeUnit == self::$day){
            return self::calculateForDayRequest($carbon , $type , $value);
        }
        else if ($timeUnit == self::$month){
            return self::calculateForMonthRequest($carbon , $type , $value);
        }
        else if ($timeUnit == self::$year){
            return self::calculateForYearRequest($carbon , $type , $value);
        }
        return  null;
    }

    public static function calculateForMillisecondRequest(Carbon $carbon , $type , $value){
        if ($type == self::$typeAdd){
            return $carbon->addMilliseconds($value);
        }
        else if ($type == self::$typeSub){
            return $carbon->subMilliseconds($value);
        }
        return null;
    }

    public static function calculateForSecondRequest(Carbon $carbon , $type , $value){
        if ($type == self::$typeAdd){
            return $carbon->addSeconds($value);
        }
        else if ($type == self::$typeSub){
            return $carbon->subSecond($value);
        }
        return null;
    }

    public static function calculateForMinuteRequest(Carbon $carbon , $type , $value){
        if ($type == self::$typeAdd){
            return $carbon->addMinutes($value);
        }
        else if ($type == self::$typeSub){
            return $carbon->subMinutes($value);
        }
        return null;
    }

    public static function calculateForHourRequest(Carbon $carbon , $type , $value){
        if ($type == self::$typeAdd){
            return $carbon->addHours($value);
        }
        else if ($type == self::$typeSub){
            return $carbon->subHours($value);
        }
        return null;
    }

    public static function calculateForDayRequest(Carbon $carbon , $type , $value){
        if ($type == self::$typeAdd){
            return $carbon->addDays($value);
        }
        else if ($type == self::$typeSub){
            return $carbon->subDays($value);
        }
        return null;
    }

    public static function calculateForMonthRequest(Carbon $carbon , $type , $value){
        if ($type == self::$typeAdd){
            return $carbon->addMonths($value);
        }
        else if ($type == self::$typeSub){
            return $carbon->subMonths($value);
        }
        return null;
    }

    public static function calculateForYearRequest(Carbon $carbon , $type , $value){
        if ($type == self::$typeAdd){
            return $carbon->addYears($value);
        }
        else if ($type == self::$typeSub){
            return $carbon->subYears($value);
        }
        return null;
    }

}
