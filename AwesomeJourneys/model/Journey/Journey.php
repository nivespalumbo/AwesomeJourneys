<?php
include_once 'model/Itinerary/ItineraryState.php';

class Journey {
    protected $id;
    protected $itinerary;
    protected $startDate;
    protected $endDate;
    protected $creator;
    
    
    public function __construct($id, CompleteItinerary $itinerary, $start_date, $end_date, $creator) {
        $this->id = $id;
        $this->itinerary = $itinerary;
        $this->startDate = $start_date;
        $this->endDate = $end_date;
        $this->creator = $creator;
    }
    
    public function __sleep(){
        return array('id', 'itinerary', 'startDate', 'endDate', 'creator');
    }
    
    public function __wakeup() {
        
    }
    
    public function getId(){
        return $this->id;
    }
    public function getStartDate(){
        return $this->startDate;
    }
    public function getEndDate(){
        return $this->endDate;
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
