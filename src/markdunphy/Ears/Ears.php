<?php namespace markdunphy\Ears;

use markdunphy\Ears\Connection;
use markdunphy\Ears\Exception\EmptyQueueException;

class Ears {

  /**
   * @var \markdunphy\Ears\Connection
   */
  protected $connection;

  /**
   * @var string
   */
  protected $queue;

  /**
   * @var \markdunphy\Ears\Publisher description
   */
  protected $publisher;

  /**
   * @param \markdunphy\Ears\Connection|null $connection only pass as null when using default settings for testing
   * @param string|null                      $queue
   */
  public function __construct( Connection $connection = null, $queue = null ) {

    $this->connection = $connection;
    $this->queue = $queue;

  } // __construct

  /**
   * @throws markdunphy\Ears\Exception\EmptyQueueException
   *
   * @return markdunphy\Ears\Publisher
   */
  public function getPublisher() {

    if ( null === $this->queue ) {
      throw new EmptyQueueException( 'A queue must be set before retrieving a Publisher instance' );
    }

    if ( null === $this->publisher ) {
      $this->publisher = new Publisher( $this->getChannel(), $this->queue );
    }

    return $this->publisher;

  } // getPublisher

  public function getConsumer() {

    return $this->getChannel();

  } // getConsumer

  /**
   * Sets and declares the queue to publish to or consume.
   *
   * @param string $queue
   */
  public function setQueue( $queue ) {

    $this->queue = $queue;

    $this->declareQueue();

    return $this;

  } // setQueue

  /**
   * Declare the queue on the channel.
   */
  protected function declareQueue() {

    $this->getChannel()->queue_declare( $this->queue, false, false, false, false );

  } // declareQueue

  /**
   * @param integer $channel_id NYI
   *
   * @return markdunphy\Ears\Channel
   */
  protected function getChannel( $channel_id = null ) {

    return $this->getConnection()->channel( $channel_id );

  } // getChannel

  /**
   * @return markdunphy\Ears\Connection
   */
  protected function getConnection() {

    if ( null === $this->connection ) {
      $this->connection = new Connection( 'localhost', 5672, 'guest', 'guest' );
    }

    return $this->connection;

  } // getConnection

} // Ears
