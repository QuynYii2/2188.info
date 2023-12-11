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
    // php artisan websocket:init
//    protected $signature = 'websocket:init';
    // php artisan websocket:init 8080
    protected $signature = 'websocket:init {port}';
    // php artisan websocket:init 127.0.0.1 8080
//    protected $signature = 'websocket:init {host} {port}';

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
//        $port = $this->argument('port');
        $port = 8080;
//        $host = $this->argument('host');
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketController()
                )
            ),
            $port
//            $host
        );

//        $socket = $server->socket;
//        $address = $socket->getAddress();
//
//        $this->info($address);
//
//        if (is_array($address)) {
//            $host = $address['host'] ?? 'localhost';
//            $port = $address['port'] ?? $port;
//
//            $this->info("WebSocket server started on $host:$port");
//        } else {
//            $this->info("Unable to retrieve server address.");
//        }
        $this->info("WebSocket server started on port $port");

        $server->run();
    }
}
