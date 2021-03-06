<?php

include_once '/model/Actor/ConcreteUserComponent.php';
include_once '../model/StayTemplate/StaySearchResult.php';

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-02-08 at 17:15:15.
 */
class ConcreteUserComponentTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ConcreteUserComponent
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new ConcreteUserComponent(session_id(), "guido.guidi@gmail.com", "Guido", "Guidi", "Via Arduino", "01255387965");
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers ConcreteUserComponent::searchStays
     * @todo   Implement testSearchStays().
     */
    public function testSearchStays() {
        $returned = $this->object->searchStays();
        $this->assertInstanceOf('StaySearchResult', $returned);
    }
}
