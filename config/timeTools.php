<?php

use App\Http\Services\onTimeService\Time\TimeService;

$titleSecond = "second";
$titleMinute = "minute";
$titleHours = "hours";
$titleMonth = "month";
$titleYear = "year";


return [

    "units"=>[
        [
            "name" => TimeService::$millisecond ,
            "name_fa" => "میلی ثانیه" ,
        ] ,
        [
            "name" => TimeService::$second ,
            "name_fa" => "ثانیه" ,
        ] ,
        [
            "name" => TimeService::$minute ,
            "name_fa" => "دقیقه" ,
        ] ,
        [
            "name" => TimeService::$hour ,
            "name_fa" => "ساعت" ,
        ] ,
        [
            "name" => TimeService::$day ,
            "name_fa" => "روز" ,
        ] ,
        [
            "name" => TimeService::$month ,
            "name_fa" => "ماه" ,
        ] ,
        [
            "name" => TimeService::$year ,
            "name_fa" => "سال" ,
        ] ,
    ],


];
