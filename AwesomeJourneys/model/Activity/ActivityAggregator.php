<?php
interface ActivityAggregator {
    public function getIterator();
    public function add(Activity $item);
    public function getObject($id);
}

?>
