<?php
include_once 'ItineraryAggregator.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItineraryConcreteAggregator
 *
 * @author Nives
 */
class ItineraryConcreteAggregator implements ItineraryAggregator{
    private $list;
    
    public function __construct() {
        $this->list = array();
    }
    
    public function __sleep() {
        return array("list");
    }

    public function __wakeup() {
        
    }

    
    public function getIterator() {
        return new ItineraryConcreteIterator($this->list);
    }
    
    public function add(ItineraryState $object) {
        $this->list[$object->getId()] = $object;
    }
    
    public function getObject($id) {
        return $this->list[$id];
    }
}
