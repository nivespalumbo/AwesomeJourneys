<?php
include_once 'ItineraryIterator.php';

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
    
    public function __sleep() {
        return array("list", "current");
    }
    public function __wakeup() {
        
    }

    
    public function next() {
        $this->current++;
        return array_values($this->list)[$this->current];
    }
    
    public function hasNext() {
        if($this->list){
            if(($this->current+1) < count($this->list, COUNT_NORMAL)){
                return TRUE;
            }
            $this->current = -1;
            return FALSE;
        } else return false;
    }
}
