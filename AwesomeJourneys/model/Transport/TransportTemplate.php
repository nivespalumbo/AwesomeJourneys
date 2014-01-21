<?php

class TransportTemplate {
    private $idTemplate;
    private $name;
    private $description;
    private $vehicle;
    
    private $locations;
    private $start_hours;
    private $durations;
    
    function __construct($idTemplate, $name, $description, $vehicle, Array $locations, Array $start_hours, Array $durations) {
        $this->idTemplate = $idTemplate;
        $this->name = $name;
        $this->description = $description;
        $this->vehicle = $vehicle;
        $this->locations = $locations;
        $this->start_hours = $start_hours;
        $this->durations = $durations;
    }
    
    public function getIdTemplate() {
        return $this->idTemplate;
    }
    public function getName() {
        return $this->name;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getVehicle() {
        return $this->vehicle;
    }
    public function getLocations() {
        return $this->locations;
    }
    public function getStart_hours() {
        return $this->start_hours;
    }
    public function getDurations() {
        return $this->durations;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setVehicle($vehicle) {
        $this->vehicle = $vehicle;
    }
    public function setLocations($locations) {
        $this->locations = $locations;
    }
    public function setStart_hours($start_hours) {
        $this->start_hours = $start_hours;
    }
    public function setDurations($durations) {
        $this->durations = $durations;
    }

    public function saveIntoDB(){
        
    }
}

?>
