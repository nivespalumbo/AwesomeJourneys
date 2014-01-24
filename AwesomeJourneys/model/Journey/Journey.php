<?php
include_once 'model/Itinerary/ItineraryState.php';

class Journey {
    public $id;
    public $itinerary;
    public $start_date;
    public $end_date;
    private $creator;
    
    
    public function __construct($id, CompleteItinerary $itinerary, $start_date, $end_date, $creator) {
        $this->id = $id;
        $this->itinerary = $itinerary;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->creator = $creator;
    }
    
    public function getId(){
        return $this->id;
    }
    public function getStartDate(){
        return $this->start_date;
    }
    public function getEndDate(){
        return $this->end_date;
    }
    public function getName(){
        return $this->name;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getCreator(){
        return $this->creator;
    }
    public function getItinerary(){
        return $this->itinerary;
    }
}

?>
