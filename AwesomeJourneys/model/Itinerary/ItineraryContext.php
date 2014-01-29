<?php
include_once 'Stay.php';
include_once 'Transfer.php';
/**
 * Description of ItineraryContext
 *
 * @author Antonio
 */
class ItineraryContext {
    private $itinerary;
    
    public function __construct(ItineraryState $itinerary) {
        $this->itinerary = $itinerary;
    }
    
    public function __sleep() {
        return array("itinerary");
    }
    public function __wakeup() { }
    
    public function getItinerary(){
        return $this->itinerary;
    }
}
