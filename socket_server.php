<?php

require './include/php_lib/ratcher/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class Chat implements MessageComponentInterface {

    protected $clients;
    protected $channel;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->channel = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connections' . "\n"
                , $from->resourceId, $msg, $numRecv);

        print_r($msg);
        $msg = json_decode($msg, true);
        $msg['hii'] = 'haha';

        foreach ($this->clients as $client) {
//            if ($from !== $client) {
            // The sender is not the receiver, send to each client connected
            $client->send(json_encode($msg));
//            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

}

$server = IoServer::factory(
                new HttpServer(
                new WsServer(
                new Chat()
                )
                ), 8080
);
$server->run();
?>