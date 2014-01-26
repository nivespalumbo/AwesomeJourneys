<?php

include_once 'AJIterator.php';

/**
 * Description of ConcreteIterator
 *
 * @author Nives
 */
class AJConcreteIterator implements AJIterator{
    private $list;
    private $current;
    
    function __construct($list) {
        $this->list = $list;
        $this->current = -1;
    }

    public function hasNext() {
        if( $this->current+1 < count($this->list, COUNT_NORMAL)){
            return TRUE;
        }
        else {
            $this->current = -1;
            return FALSE;
        }
    }

    public function next() {
        $this->current++;
        return array_values($this->list)[$this->current];
    }

    public function __sleep() {
        return array('list', 'current');
    }
    public function __wakeup() {
        
    }
    
}
