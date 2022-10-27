<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{

    protected $signature = 'shop:refresh';

    protected $description = 'Refresh';

    public function handle(): int
    {
        if (app()->isProduction()) {
            return Command::FAILURE;
        }
        Storage::deleteDirectory('images/products');
        Storage::makeDirectory('images/products');
        $this->call('migrate:fresh', [
            '--seed' => true
        ]);


        return Command::SUCCESS;
    }
}
