<?php
include_once 'ItineraryIterator.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItineraryConcreteIterator
 *
 * @author Nives
 */
class ItineraryConcreteIterator implements ItineraryIterator{
    private $list;
    private $current;
    
    public function __construct($list) {
        $this->list = &$list;
        $this->current = -1;
    }
    
    public function next() {
        $this->current++;
        return array_values($this->list)[$this->current];
    }
    
    public function hasNext() {
        if($this->list)
            return ($this->current+1) < count($this->list, COUNT_NORMAL);
        else return false;
    }
}
