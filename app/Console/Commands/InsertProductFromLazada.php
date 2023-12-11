<?php

namespace App\Console\Commands;

use App\Http\Controllers\InsertProductController;
use Illuminate\Console\Command;

class InsertProductFromLazada extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    /* php artisan insert-product-lazada-key phone */
    protected $signature = 'insert-product-lazada-key {keyword}';

    protected $insertProductController;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(InsertProductController $insertProductController)
    {
        parent::__construct();
        $this->insertProductController = $insertProductController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $keyword = $this->argument('keyword');
        $this->insertProductController->insertProductFromLazada($keyword);
    }
}
