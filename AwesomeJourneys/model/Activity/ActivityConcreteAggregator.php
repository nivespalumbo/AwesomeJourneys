<?php
include_once 'ActivityAggregator.php';
include_once 'ActivityConcreteIterator.php';

class ActivityConcreteAggregator implements ActivityAggregator{
    private $list;
    
    public function getIterator() {
        return new ActivityConcreteIterator($this->list);
    }
    
    public function add(Activity $object) {
        $this->list[] = $object;
    }
}

?>
