<?php
include_once 'Journey.php';
include_once 'PublishedJourney.php';
include_once 'JourneyIterator.php';

interface JourneyAggregator {
    public function getIterator();
    public function add(Journey $object);
    public function getObject($id);
}
?>
