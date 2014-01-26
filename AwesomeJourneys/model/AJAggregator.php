<?php

/**
 *
 * @author Nives
 */
interface AJAggregator {
    public function getIterator();
    public function getObject($key);
    public function add($key, $object);
}
