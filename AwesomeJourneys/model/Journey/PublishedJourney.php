<?php

class PublishedJourney extends Journey{
    private $publishDate;
    
    public function __construct($id, CompleteItinerary $itinerary, $start_date, $end_date, $creator, $publish_date) {
        parent::__construct($id, $itinerary, $start_date, $end_date, $creator);
        $this->publishDate = $publish_date;
    }
    
    public function __sleep(){
        return array('id', 'itinerary', 'startDate', 'endDate', 'creator', 'publishDate');
    }
}

?>
