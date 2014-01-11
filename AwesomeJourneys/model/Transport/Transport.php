<?php

class Transport implements StayTemplateLeaf{
    private $id;
    private $description;
    private $name;
    private $stayTempalateId;
    private $duration;
    private $vehicle;
    private $startDate;
    private $endDate;
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
        return $this->description;
    }

    public function addComponent(\StayTemplateComponent $component) {
        return FALSE;
    }

    public function getAccomodation() {
        return FALSE;
    }

    public function getActivities() {
        return FALSE;
    }

    public function getEndDate() {
        return FALSE;
    }

    public function getName() {
        return $this->name;
    }

    public function getStartDate() {
        
    }

    public function getTransports() {
        
    }

    public function getType() {
        
    }

    public function isComposite() {
        
    }

    public function newItineraryBick() {
        
    }

    public function removeComponent($id) {
        
    }

    public function setDescription($description) {
        
    }

    public function setEndDate($startDate) {
        
    }

    public function setEndLocation($location) {
        
    }

    public function setLocation($location) {
        
    }

    public function setName($name) {
        
    }

    public function setStartDate($endDate) {
        
    }

    public function setStartLocation($location) {
        
    }

}

?>
