<?php
interface ActivityAggregator {
    public function getIterator();
    public function add($item);
}

?>
