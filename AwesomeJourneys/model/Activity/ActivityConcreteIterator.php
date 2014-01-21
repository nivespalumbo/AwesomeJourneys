<?php
include_once 'ActivityIterator.php';

class ActivityConcreteIterator implements ActivityIterator{
    private $activities;
    private $current;
    
    public function __construct($list) {
        $this->activities = $list;
        $this->current = -1;
    }
    
    public function __sleep() {
        return array("activities", "current");
    }

    public function __wakeup() {
        
    }

    
    public function hasNext() {
        return ($this->current+1) < count($this->activities, COUNT_NORMAL);
    }
    
    public function nextItem() {
        $this->current++;
        return array_values($this->activities)[$this->current];
    }
}

?>
