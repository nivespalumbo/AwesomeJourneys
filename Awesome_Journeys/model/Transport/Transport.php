<?php

class Transport implements StayTemplateLeaf{
    private $id;
    private $stayTempalateId;
    private $duration;
    private $vehicle;
    private $start_location;
    private $end_location;
    
    public function __construct($id, $stayTemplateId, $duration, $vehicle, $start_location, $end_location) {
        $this->id = $id;
        $this->stayTempalateId = $stayTemplateId;
        $this->duration = $duration;
        $this->vehicle = $vehicle;
        $this->start_location = $start_location;
        $this->end_location = $end_location;
    }

    public function getEndLocation() {
        return $this->end_location;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getDuration(){
        return $this->duration;
    }
    
    public function getVehicle(){
        return $this->vehicle;
    }

    public function getLocation() {
        return FALSE;
    }

    public function getStartLocation() {
        return $this->start_location;
    }

    public function getDescription() {
        return FALSE;
    }    
}

?>
