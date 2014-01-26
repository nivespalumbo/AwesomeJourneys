<?php

/**
 * Description of CompleteItinerary
 *
 * @author Nives
 */
class CompleteItinerary extends ItineraryState{
    function __construct($id, $name, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
    
    public function getType() {
        return COMPLETE;
    }


}
