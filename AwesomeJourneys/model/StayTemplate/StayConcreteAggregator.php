<?php
include_once 'StayAggregator.php';
include_once 'StayConcreteIterator.php';

class StayConcreteAggregator implements StayAggregator{
    private $list;
       
    public function getIterator() {
        return new StayConcreteIterator($this->list);
    }
    
    public function add(StayTemplateComponent $object) {
        $this->list[] = $object;
    }
}

?>
