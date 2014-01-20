<?php
interface ActivityAggregator {
    public function getIterator();
    public function add(Activity $item);
}

?>
