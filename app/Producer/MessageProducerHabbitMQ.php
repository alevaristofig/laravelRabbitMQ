<?php
 
    namespace App\Producer;

    use PhpAmqpLib\Connection\AMQPStreamConnection;
    use PhpAmqpLib\Message\AMQPMessage;

    class MessageProducerHabbitMQ {

        private $connection;
        private $channel;

        public function __construct() {            
            $this->connection = new AMQPStreamConnection("localhost", 5672, "guest", "guest");            
            $this->channel = $this->connection->channel();
        }

        public function produzir(array $message): void { 
            try {
                $this->channel->exchange_declare("laravel_messages","direct");    
                $this->channel->queue_declare("laravel_messages_queue");
                $this->channel->queue_bind("laravel_messages_queue","laravel_messages","laravel");
                
                $message = new AMQPMessage(json_encode($message));

                $this->channel->basic_publish($message,"laravel_messages","laravel");

                $this->channel->close();
                $this->connection->close();
            } catch(Exception $e) {
                dd("Erro na produção da mensagem ".$e->getMessage());
            }
            
        }
    }