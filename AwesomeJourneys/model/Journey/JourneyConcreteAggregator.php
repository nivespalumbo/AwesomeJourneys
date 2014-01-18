<?php
include_once 'JourneyAggregator.php';

class JourneyConcreteAggregator implements JourneyAggregator{
    private $list;
       
    public function createIterator() {
        return new JourneyConcreteIterator($this->list);
    }
    
    public function add(Journey $object) {
        $this->list[] = $object;
    }
}
?>
