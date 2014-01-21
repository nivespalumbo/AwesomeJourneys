<?php
include_once 'StayAggregator.php';
include_once 'StayConcreteIterator.php';

class StayConcreteAggregator implements StayAggregator{
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
        return new StayConcreteIterator($this->list);
    }
    
    public function add(StayTemplateComponent $object) {
        $this->list[$object->getId()] = $object;
    }
    
    public function getObject($id){
        return $this->list[$id];
    }
}

?>
