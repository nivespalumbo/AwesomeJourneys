<?php
include_once 'Oggetti/ItineraryInHTML.php';

$view = new ItineraryInHTML($this->model);
$view->getItinerary();

?>