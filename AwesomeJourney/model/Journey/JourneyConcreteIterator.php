<?php
include_once 'JourneyIterator.php';

class JourneyConcreteIterator implements JourneyIterator {
    private $list;
    private $current;
    
    public function __construct($list) {
        $this->list = &$list;
        $this->current = -1;
    }
    
    public function next() {
        $this->current++;
        return $this->list[$this->current];
    }
    
    public function hasNext() {
        if($this->list)
            return ($this->current+1) < count($this->list, COUNT_NORMAL);
        else return false;
    }
}
?>
