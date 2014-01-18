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
       
    public function createIterator() {
        return new ItineraryConcreteIterator($this->list);
    }
    
    public function add(ItineraryState $object) {
        $this->list[] = $object;
    }
}
