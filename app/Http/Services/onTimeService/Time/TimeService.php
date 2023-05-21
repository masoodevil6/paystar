<?php
namespace App\Http\Services\onTimeService\Time;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Config;

class  TimeService extends TimeTools {

    public static function getDateFromNowInstance ( $timeUnit , $type , $value = 1){
        return self::calculateRequest(Carbon::now() ,  $timeUnit , $type , $value);
    }
    public static function getDateFromNowString ( $timeUnit , $type , $value = 1){
        return self::calculateRequest(Carbon::now() ,  $timeUnit , $type , $value)->toDateTimeString();
    }
    public static function getDateFromNowToTimeStamp ( $timeUnit , $type , $value = 1){
        return self::getDateFromNowInstance($timeUnit , $type , $value)->getTimestamp();
    }




    public static function calculateDateFromTimeInstance ($timeSting , $timeUnit , $type , $value = 1){
        return self::calculateRequest(Carbon::parse($timeSting) ,  $timeUnit , $type , $value);
    }
    public static function calculateDateFromTimeString ($timeSting , $timeUnit , $type , $value = 1){
        return self::calculateRequest(Carbon::parse($timeSting) ,  $timeUnit , $type , $value)->toDateTimeString();
    }
    public static function calculateDateFromTimeToTimeStamp ($timeSting , $timeUnit , $type , $value = 1){
        return self::calculateDateFromTimeInstance($timeSting , $timeUnit , $type , $value)->getTimestamp();
    }




    public static function calculateDateFromTimeStampInstance ($timeStamp , $timeUnit , $type , $value = 1){
        return self::calculateRequest(Carbon::createFromTimestamp($timeStamp) ,  $timeUnit , $type , $value);
    }
    public static function calculateDateFromTimeStampString ($timeStamp , $timeUnit , $type , $value = 1){
        return self::calculateRequest(Carbon::createFromTimestamp($timeStamp) ,  $timeUnit , $type , $value)->toDateTimeString();
    }




    public static function calculateDateNowInstance(){
        return Carbon::now();
    }
    public static function calculateDateNowString(){
        return Carbon::now()->toDateTimeString();
    }
    public static function calculateDateNowToTimeStamp(){
        return Carbon::now()->timestamp;
    }


    public static function calculateDateTimeStampInstance($timeStamp){
        return Carbon::createFromTimestamp($timeStamp);
    }
    public static function calculateDateTimeStampString($timeStamp){
        return Carbon::createFromTimestamp($timeStamp)->toDateTimeString();
    }
    public static function calculateDateTimeStampMillisecondsToString($timeStamp){
        $timestamp = (int) round($timeStamp / pow(10, 6 - 3));
        return Carbon::createFromTimestamp($timestamp)->toDateTimeString();
    }




    public static function convertTimeStringToTimeStamp($timeSting){
        $date = new DateTime($timeSting);
        return $date->getTimestamp();
    }
    public static function convertTimeCarbonToString(Carbon $timeCarbon){
        return $timeCarbon->toDateTimeString();
    }

}
