<?php
include_once 'CompleteItinerary.php';
include_once 'PartialItinerary.php';
include_once 'ItineraryState.php';
include_once 'ItineraryIterator.php';

interface ItineraryAggregator {
    public function createIterator();
    public function add(ItineraryState $object);
    public function getObject($id);
}
?>
