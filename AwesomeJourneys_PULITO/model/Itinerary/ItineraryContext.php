<?php

include_once 'ItineraryState.php';

/**
 * Description of ItineraryContext
 *
 * @author Nives
 */
class ItineraryContext {
    private $itineraries;
    
    function __construct() {
        $this->itineraries = array();
    }
    
    function getItinerary($key){
        if(array_key_exists($key, $this->itineraries)){
            return $this->itineraries[$key];
        }
        return NULL;
    }
    
    function addItinerary($key, ItineraryState $itinerary){
        $this->itineraries[$key] = $itinerary;
    }
    
    function removeItinerary($key){
        if(array_key_exists($key, $this->itineraries)){
            unset($this->itineraries[$key]);
        }
    }
    
    function __sleep() {
        return array('itineraries');
    }
    
    function __wakeup() {
        
    }
}
