<?php

namespace App\Console\Commands;

use App\Http\Services\onTimeService\Admins\PanelAdminService;
use App\Http\Services\onTimeService\Login\ConfirmLoginService;
use App\Http\Services\onTimeService\Login\LoginService;
use App\Http\Services\onTimeService\Time\TimeService;
use App\Models\Panel\Admin;
use App\Repositories\ContextRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Testing\Fluent\Concerns\Has;

class CreateFackSubscribePanel extends Command
{

    ////=========================================================
    /// info comment
    ////=========================================================
    protected $signature =  'subscribe:fake';

    protected $description = 'Command description create subscribe fake';

    public function handle()
    {

        ContextRepository::SubscribeRepository()->addResult([
            "title" => "اشتراک شماره 1" ,
            "description" => "متن برای اشتراک اول" ,
            "slug" => "اشتراک-اول" ,
            "real_price" => "1000" ,
            "off_price" => "500" ,
            "duration" => "1" ,
            "status" => "1" ,
        ]);

        ContextRepository::SubscribeRepository()->addResult([
            "title" => "اشتراک شماره 2" ,
            "description" => "متن برای اشتراک اول" ,
            "slug" => "اشتراک-دوم" ,
            "real_price" => "1500" ,
            "off_price" => "1000" ,
            "duration" => "1" ,
            "status" => "1" ,
        ]);

        ContextRepository::SubscribeRepository()->addResult([
            "title" => "اشتراک شماره 3" ,
            "description" => "متن برای اشتراک سوم" ,
            "slug" => "اشتراک-سوم" ,
            "real_price" => "2000" ,
            "off_price" => "1500" ,
            "duration" => "1" ,
            "status" => "1" ,
        ]);


        return Command::SUCCESS;
    }


}
