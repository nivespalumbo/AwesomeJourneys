<?php
include_once 'Journey.php';
include_once 'PublishedJourney.php';
include_once 'JourneyIterator.php';

interface JourneyAggregator {
    public function createIterator();
    public function add(Journey $object);
}
?>
