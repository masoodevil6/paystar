<?php

namespace App\Console\Commands;

use App\Repositories\ContextRepository;
use Illuminate\Console\Command;

class DeleteUserDisabledDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corn:delete-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete user that disable in last days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ContextRepository::UserRepository()->deleteDeActiveClients();
        return Command::SUCCESS;
    }
}
