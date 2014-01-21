<?php

/**
 * Description of ItineraryContext
 *
 * @author Antonio
 */
class ItineraryContext {
    private $itinerary;
    
    public function __construct($creator, ItineraryState $itinerary = NULL) {
        if($itinerary != NULL){
            $this->itinerary = $itinerary;
        }
        else{
            $this->itinerary = new PartialItinerary($creator, NULL, $_POST['name'], $_POST['description']);
        }
    }
    
    public function __sleep() {
        return array("itinerary");
    }

    public function __wakeup() {
        
    }

    
    public function getItinerary(){
        return $this->itinerary;
    }
    
    public function setItinerary(ItineraryState $itinerary){
        $this->itinerary = $itinerary;
    }
}
