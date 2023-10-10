#!/usr/bin/php
<?php
    // include the php-amqplib library
    require_once __DIR__ . '/vendor/autoload.php';
    use PhpAmqpLib\Connection\AMQPStreamConnection;
    use PhpAmqpLib\Message\AMQPMessage;

    // create connection to the server
    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $channel = $connection->channel();

    // declare a queue for to send then it publish a message to the queue
    $channel->queue_declare('hello', false, false, false, false);

    $msg = new AMQPMessage('Hello World!');
    $channel->basic_publish($msg, '', 'hello');

    echo "[x] Sent 'Hello World!'\n";

    // close connection
    $channel->close();
    $connection->close();
?>
