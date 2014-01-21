<?php

class PublishedJourney extends Journey{
    public $publish_date;
    
    public function __construct($id, CompleteItinerary $itinerary, $start_date, $end_date, $price, $creator, $publish_date) {
        parent::__construct($id, $itinerary, $start_date, $end_date, $price, $creator);
        $this->publish_date = $publish_date;
    }
}

?>
