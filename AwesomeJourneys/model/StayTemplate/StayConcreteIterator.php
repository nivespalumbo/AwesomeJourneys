<?php
include_once 'StayIterator.php';

class StayConcreteIterator implements StayIterator{
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
        if($this->list)
            return ($this->current+1) < count($this->list, COUNT_NORMAL);
        else return false;
    }
    
    public function replay(){
        $this->current = -1;
    }
}

?>
