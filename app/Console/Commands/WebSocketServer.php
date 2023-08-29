<?php

namespace App\Console\Commands;

use App\Http\Controllers\SocketController;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class WebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // php artisan websocket:init 8090
    protected $signature = 'websocket:init {port}';

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
        $port = $this->argument('port');
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketController()
                )
            ),
            $port
        );

        $this->info("WebSocket server started on port $port");

        $server->run();
    }
}
