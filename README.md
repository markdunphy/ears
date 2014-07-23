Ears
====

A PHP RabbitMQ library using php-amqplib

##Basic Usage
These examples use the default `localhost` RabbitMQ server created when you install it. For production use (and you're crazy if you're doing this), you should configure a `markdunphy\Ears\Connection` object to pass in as the first argument to the `markdunphy\Ears\Ears` constructor.

Below is a simple `hello world` demonstration. Run the consumer code in one terminal tab and the publisher in another to watch things happen.

#####Configuring a Consumer
```php
use \markdunphy\Ears\Ears;

$consumer = ( new Ears )->getConsumer();

$consumer->consumeBasic( 'hello', function( $message ) {
  echo $message->body . "\n";
} );
```

#####Configuring a Publisher
```php
use \markdunphy\Ears\Ears;

$ears = new Ears( null, 'hello' );

$publisher = $ears->getPublisher();

$publisher->sendBasic( 'Hello world' );
```
