<?php

class EarsTest extends PHPUnit_Framework_TestCase {

  /**
   * @test
   */
  public function getPublisherSuccess() {

    $channel = $this->getMockBuilder( 'markdunphy\Ears\Channel' )
                    ->disableOriginalConstructor()
                    ->getMock();

    $connection = $this->getMockBuilder( 'markdunphy\Ears\Connection' )
                       ->disableOriginalConstructor()
                       ->setMethods( [ 'channel' ] )
                       ->getMock();

    $connection->expects( $this->once() )
               ->method( 'channel' )
               ->will( $this->returnValue( $channel ) );

    $queue = 'hello';

    $ears = new \markdunphy\Ears\Ears( $connection, $queue );

    $publisher = $ears->getPublisher();

    $this->assertInstanceOf( 'markdunphy\Ears\Publisher', $publisher );

  } // getPublisherSuccess

  /**
   * An exception should be thrown when there is no queue set.
   *
   * @test
   * @expectedException markdunphy\Ears\Exception\EmptyQueueException
   */
  public function getPublisherException() {

    $connection = $this->getMockBuilder( 'markdunphy\Ears\Connection' )
                       ->disableOriginalConstructor()
                       ->getMock();

    $ears = new \markdunphy\Ears\Ears( $connection );

    $ears->getPublisher();

  } // getPublisherException

} // EarsTest
