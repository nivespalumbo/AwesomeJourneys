<?php
include_once 'model/Itinerary/ItineraryComponent.php';

class Journey {
    public $itinerary;
    public $start_date;
    public $end_date;
    public $price;
    private $creator;
    
    
    public function __construct(ItineraryComponent $itinerary, $start_date, $end_date, $price, $creator) {
        $this->itinerary = $itinerary;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->price = $price;
        $this->creator = $creator;
    }
    
    public function get_start_date(){
        return $this->start_date;
    }
    
    public function get_end_date(){
        return $this->end_date;
    }
    
    public function get_price(){
        return $this->price;
    }
    
    public function get_name(){
        return $this->name;
    }
    
    public function get_description(){
        return $this->description;
    }
    
    public function get_category(){
        return$this->category;
    }
    
    public function get_tag(){
        return $this->tag;
    }
    
    public function get_photo(){
        return $this->photo;
    }
    
    public function get_crator(){
        return $this->creator;
    }
    
    public function get_itinerary_creator(){
        return $this->itinerary->get_creator();
    }
    
    public function get_itinerary(){
        return $this->itinerary;
    }
}

?>
