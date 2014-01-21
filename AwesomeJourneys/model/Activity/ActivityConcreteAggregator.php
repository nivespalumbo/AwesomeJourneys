<?php
include_once 'ActivityAggregator.php';
include_once 'ActivityConcreteIterator.php';

class ActivityConcreteAggregator implements ActivityAggregator{
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
        return new ActivityConcreteIterator($this->list);
    }
    
    public function add(Activity $object) {
        $this->list[$object->getId()] = $object;
    }
    
    public function getObject($id) {
        return $this->list[$id];
    }
}

?>
