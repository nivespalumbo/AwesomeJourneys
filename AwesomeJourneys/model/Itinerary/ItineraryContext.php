<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
            $this->itinerary = new PartialItinerary($creator);
        }
    }
    
    public function getItinerary(){
        return $this->itinerary;
    }
    
    public function setItinerary(ItineraryState $itinerary){
        $this->itinerary = $itinerary;
    }
}
