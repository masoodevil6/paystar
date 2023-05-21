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

class CreateUserAdminPanel extends Command
{

    ////=========================================================
    /// info comment
    ////=========================================================
    protected $signature =  'panel:User';

    protected $description = 'Command description create user panel admin';

    public function handle()
    {
        $userName =  $this->ask('user first name');
        $userFamily =  $this->ask('user family name');
        $userEmail =  $this->ask('user email [real]');

        $user = ContextRepository::UserRepository()->addResult([
            "name" => $userName,
            "family" => $userFamily,
            "email" => $userEmail,
            "password" => "",
            "activation" => 1 ,
            "status" => 1,
            "email_verified_at" => TimeService::calculateDateNowString(),
            "activation_time" => TimeService::calculateDateNowString(),
        ]);


        $admin = ContextRepository::AdminRepository()->addResult([
            "title" => "ادمین اصلی",
            "status" => 1,
            "main" => Admin::getPanelPass()
        ]);

        $password =  $this->ask('password panel admin');


        ContextRepository::AdminUserRepository()->addResult([
            "password" => Hash::make($password),
            "status" => 1,
            "user_id" => $user->id ,
            "admin_id" => $admin->id
        ]);


        return Command::SUCCESS;
    }


}
