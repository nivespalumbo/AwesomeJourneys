<?php
include_once 'JourneyAggregator.php';

class JourneyConcreteAggregator implements JourneyAggregator{
    private $list;
       
    public function getIterator() {
        return new JourneyConcreteIterator($this->list);
    }
    
    public function add(Journey $object) {
        $this->list[$object->getId()] = $object;
    }
    
    public function getObject($id) {
        return $this->list[$id];
    }
}
?>
