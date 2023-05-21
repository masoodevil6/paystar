<?php

namespace App\Console\Commands;

use App\Models\Banks\Bank;
use App\Repositories\ContextRepository;
use Illuminate\Console\Command;

class CheckUnVerifiedPaymentCornJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corn:check-un-verified-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check unverified Payment for verified and submit';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $unVerifiedPaymentService = new UnVerifiedPaymentService();
        $unVerifiedPaymentService->CheckUnVerifiedPayment();
        return Command::SUCCESS;
    }


}
