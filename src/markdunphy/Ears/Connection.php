<?php namespace markdunphy\Ears;

use PhpAmqpLib\Connection\AMQPConnection;
use markdunphy\Ears\Channel;

class Connection extends AMQPConnection {

  protected $host;
  protected $port;
  protected $user;
  protected $password;

  /**
   * {@inheritdoc}
   */
  public function __construct( $host, $port, $user, $password, $vhost = "/", $insist = false, $login_method = "AMQPLAIN", $login_response = null, $locale = "en_US", $connection_timeout = 3, $read_write_timeout = 3, $context = null ) {

    $this->host = $host;
    $this->port = $port;
    $this->user = $user;
    $this->password = $password;

    parent::__construct( $host, $port, $user, $password, $vhost, $insist, $login_method, $login_response, $locale, $connection_timeout, $read_write_timeout, $context );

  } // __construct

  /**
   * @param integer $channel_id
   *
   * @return markdunphy\Ears\Channel
   */
  public function channel( $channel_id = null ) {

    if ( isset( $this->channels[ $channel_id ] ) ) {
      return $this->channels[ $channel_id ];
    }

    $channel_id = $channel_id ? $channel_id : $this->get_free_channel_id();

    $channel = new Channel( $this->connection, $channel_id );

    $this->channels[ $channel_id ] = $channel;

    return $channel;

  } // channel

} // Connection
