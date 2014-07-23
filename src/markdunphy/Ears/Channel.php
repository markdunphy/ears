<?php namespace markdunphy\Ears;

use PhpAmqpLib\Channel\AMQPChannel;

class Channel extends AMQPChannel {

  /**
   * Consume a basic queue.
   *
   * @param string $queue
   * @param Closure $callable
   */
  public function consumeBasic( $queue, $callable ) {

    $this->basic_consume( $queue, '', false, true, false, false, $callable );

    $this->listen( $queue, $callable );

  } // consumeBasic

  public function listen( $queue, $callable ) {

    while ( count( $this->callbacks ) > 0 )  {
      $this->wait();
    }

  } // listen

} // Channel
