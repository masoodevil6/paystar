<?php

namespace App\Console\Commands;

use App\Repositories\ContextRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteOrderClientWithoutOrderBasketCornJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corn:delete-order-without-basket-client';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete order without baskets client that expired in period (last 7 day)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ContextRepository::OrderRepository()->deleteOrdersWithoutBaskets();
        return Command::SUCCESS;
    }
}
