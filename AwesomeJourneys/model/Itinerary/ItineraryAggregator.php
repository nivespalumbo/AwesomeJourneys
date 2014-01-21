<?php
include_once 'ItineraryState.php';
include_once 'ItineraryConcreteIterator.php';

interface ItineraryAggregator {
    public function getIterator();
    public function add(ItineraryState $object);
    public function getObject($id);
}
?>
