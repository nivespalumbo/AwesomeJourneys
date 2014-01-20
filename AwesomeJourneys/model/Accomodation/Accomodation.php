<?php

class Accomodation implements StayTemplateLeaf{
    private $id;
    private $location;
    private $type;
    private $description;
    private $category;
    private $name;
    private $link;
    private $stayTempalateId;
    private $check_in;
    private $startDate;
    private $endDate;
    
    //DA INSERIRE DURATION
    public function __construct($id, $location, $type, $description, $name, $link, $stayTempalateId, $check_in, $category) {
        $this->id = $id;
        $this->location = $location;
        $this->type = $type;
        $this->description = $description;
        //$this->duration = $duration;
        $this->name = $name;
        $this->link = $link;
        $this->stayTempalateId = $stayTempalateId;
        $this->check_in = $check_in;
        $this->category = $category;
    }
    
     public function getEndLocation() {
        return FALSE;
    }

    public function getStartLocation() {
        return FALSE;
    }
    
    public function getLocation(){
        return $this->location;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getAccomodations(){
        $accomodation = array();
        $accomodation[] = $this;
        return $accomodation;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getVehicle() {
        return FALSE;
    }

    public function addComponent(\StayTemplateComponent $component) {
        
    }

    public function getActivities() {
        return FALSE;
    }

    public function getEndDate() {
        
    }

    public function getName() {
        
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
