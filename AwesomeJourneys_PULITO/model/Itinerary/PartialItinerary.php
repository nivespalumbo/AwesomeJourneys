<?php

/**
 * Description of PartialItinerary
 *
 * @author Nives
 */
class PartialItinerary extends ItineraryState{
    function __construct($id, $name, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
    
    public function getType() {
        return PARTIAL;
    }
}
