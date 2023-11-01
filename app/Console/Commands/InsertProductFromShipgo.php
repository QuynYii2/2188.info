<?php

namespace App\Console\Commands;

use App\Http\Controllers\MainController;
use Illuminate\Console\Command;

class InsertProductFromShipgo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    /*
     * php artisan insert-product {option}
     * option: shipgo || shoppe || lazada
     */
    protected $signature = 'insert-product {serve}';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $serve = $this->argument('serve');
        (new MainController())->insertProduct($serve);
    }
}
