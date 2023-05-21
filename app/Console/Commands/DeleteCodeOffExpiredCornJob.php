<?php

namespace App\Console\Commands;

use App\Repositories\ContextRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteCodeOffExpiredCornJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corn:delete-code-off';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete code off that expired in period';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ContextRepository::CodeOffRepository()->DeleteCodeOffExpired();
        return Command::SUCCESS;
    }
}
