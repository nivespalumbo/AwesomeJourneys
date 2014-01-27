<?php

/**
 * Description of PartialItinerary
 *
 * @author Nives
 */
class PartialItinerary extends ItineraryState{
    function __construct($id, $name, $description, $creator) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->creator = $creator;
        
        if($this->id == NULL){
            $this->saveIntoDb();
        }
    }
    
    public function getType() {
        return PARTIAL;
    }
}
