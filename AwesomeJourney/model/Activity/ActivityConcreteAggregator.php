<?php
use \ActivityConcreteIterator;

class ActivityConcreteAggregator implements ActivityAggregator{
    private $list;
    
    public function __construct($query) {
        $c = new Connection();
        if($c){
            $this->list = $c->query($query);
            $c->close();
        }
    }
    
    public function getIterator() {
        return new ActivityConcreteIterator($this->list);
    }
    
    public function add($object) {
        $this->list[] = $object;
    }
}

?>
