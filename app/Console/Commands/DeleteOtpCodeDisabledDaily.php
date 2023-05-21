<?php

namespace App\Console\Commands;

use App\Repositories\ContextRepository;
use Illuminate\Console\Command;

class DeleteOtpCodeDisabledDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corn:delete-otp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete otp code that disable in last days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ContextRepository::OtpRepository()->deleteOtpCodeExpiredLastDay();
        return Command::SUCCESS;
    }
}
