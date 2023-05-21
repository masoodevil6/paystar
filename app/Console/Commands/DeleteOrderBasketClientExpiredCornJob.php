<?php

namespace App\Console\Commands;

use App\Repositories\ContextRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteOrderBasketClientExpiredCornJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corn:delete-order-basket-client';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete order basket client that expired in period';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ContextRepository::OrderBasketRepository()->DeleteOrderBasketExpired();
        return Command::SUCCESS;
    }
}
