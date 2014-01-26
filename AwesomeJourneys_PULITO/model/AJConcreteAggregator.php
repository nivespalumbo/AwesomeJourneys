<?php

include_once 'AJAggregator.php';
include_once 'AJConcreteIterator.php';

/**
 * Description of ConcreteAggregator
 *
 * @author Nives
 */
class AJConcreteAggregator implements AJAggregator{
    private $list;
    
    function __construct() {
        $this->list = array();
    }
    
    public function add($key, $object) {
        $this->list[$key] = $object;
    }

    public function getIterator() {
        return new AJConcreteIterator($this->list);
    }

    public function getObject($key) {
        if(array_key_exists($key, $this->list)){
            return $this->list[$key];
        }
        return NULL;
    }

    public function __sleep() {
        return array('list');
    }
    public function __wakeup() {
        
    }

}
