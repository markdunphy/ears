<?php namespace markdunphy\Ears;

class Publisher {

  /**
   * @var markdunphy\Ears\Channel
   */
  protected $channel;

  /**
   * @var string|null
   */
  protected $queue;

  /**
   * @param markdunphy\Ears\Channel $channel
   * @param string $queue
   */
  public function __construct( Channel $channel, $queue ) {

    $this->channel = $channel;
    $this->queue = $queue;

  } // __construct

  /**
   * @param string $body description
   */
  public function sendBasic( $body ) {

    $message = new Message( $body );

    $this->channel->basic_publish( $message, '', $this->queue );

  } // sendBasic

} // Publisher
