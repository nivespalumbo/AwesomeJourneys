<?php
include_once 'model/Itinerary/ItineraryState.php';

class Journey {
    public $itinerary;
    public $start_date;
    public $end_date;
    public $price;
    private $creator;
    
    
    public function __construct(CompleteItinerary $itinerary, $start_date, $end_date, $price, $creator) {
        $this->itinerary = $itinerary;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->price = $price;
        $this->creator = $creator;
    }
    
    public function getStartDate(){
        return $this->start_date;
    }
    
    public function getEndDate(){
        return $this->end_date;
    }
    
    public function getPrice(){
        return $this->price;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getCategory(){
        return$this->category;
    }
    
    public function getTag(){
        return $this->tag;
    }
    
    public function getPhoto(){
        return $this->photo;
    }
    
    public function getCreator(){
        return $this->creator;
    }
    
    public function getItineraryCreator(){
        return $this->itinerary->get_creator();
    }
    
    public function getItinerary(){
        return $this->itinerary;
    }
}

?>
