<?php

class PublishedJourney extends Journey{
    public $publish_date;
    
    public function __construct(ItineraryComponent $itinerary, $start_date, $end_date, $price, $creator, $publish_date) {
        parent::__construct($itinerary, $start_date, $end_date, $price, $creator);
        $this->publish_date = $publish_date;
    }
}

?>
