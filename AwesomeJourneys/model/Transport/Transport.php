<?php
include_once 'TransportTemplate.php';

class Transport extends TransportTemplate implements StayTemplateLeaf{
    private $id;
    private $startIndex;
    private $endIndex;
    
    private $date;
    
    function __construct($id, $startIndex, $endIndex, $date, $idTemplate, $name, $description, $vehicle, $locations, $start_hours, $durations) {
        parent::__construct($idTemplate, $name, $description, $vehicle, $locations, $start_hours, $durations);
        $this->id = $id;
        $this->startIndex = $startIndex;
        $this->endIndex = $endIndex;
        $this->date = $date;
    }
    
    public function __sleep() {
        return array("id", "startIndex", "endIndex", "date", "idTemplate", "name", "description", "vehicle", "locations", "start_hours", "durations");
    }

    public function __wakeup() {
        
    }

    public function getId() {
        return $this->id;
    }
    public function getDate() {
        return $this->date;
    }
    
    public function setStartIndex($startIndex) {
        $this->startIndex = $startIndex;
    }
    public function setEndIndex($endIndex) {
        $this->endIndex = $endIndex;
    }
    public function setDate($date) {
        $this->date = $date;
    }
    
    public function saveIntoDB() {
        parent::saveIntoDB();
    }

    public function addComponent(\StayTemplateComponent $component) {
        return FALSE;
    }

    public function getAccomodations() {
        return FALSE;
    }

    public function getActivities() {
        return FALSE;
    }

    public function getEndDate() {
        return FALSE;
    }

    public function getEndLocation() {
        return $this->locations[$this->endIndex];
    }

    public function getLocation() {
        return FALSE;
    }

    public function getStartDate() {
        return $this->date;
    }

    public function getStartLocation() {
        return $this->locations[$this->startIndex];
    }

    public function getTransports() {
        return $this;
    }

    public function getType() {
        return TRANSPORT;
    }

    public function isComposite() {
        return FALSE;
    }

    public function newItineraryBick() {
        return FALSE;
    }

    public function removeComponent($id) {
        return FALSE;
    }

    public function setEndDate($startDate) {
        return FALSE;
    }

    public function setEndLocation($location) {
        $this->endIndex = array_search($location, $this->locations);
    }

    public function setLocation($location) {
        return FALSE;
    }

    public function setStartDate($endDate) {
        $this->date = $endDate;
    }

    public function setStartLocation($location) {
        $this->startIndex = array_search($location, $this->locations);
    }

    public function getDuration() {
        return array_sum(array_slice($this->durations, $this->startIndex, $this->endIndex - $this->startIndex));
    }

    



//    public function __construct($id, $stayTemplateId, $duration, $vehicle, $start_location, $end_location) {
//        $this->id = $id;
//        $this->stayTempalateId = $stayTemplateId;
//        $this->duration = $duration;
//        $this->vehicle = $vehicle;
//        $this->start_location = $start_location;
//        $this->end_location = $end_location;
//    }
//
//    public function getEndLocation() {
//        return $this->end_location;
//    }
//
//    public function getId() {
//        return $this->id;
//    }
//    
//    public function getDuration(){
//        return $this->duration;
//    }
//    
//    public function getVehicle(){
//        return $this->vehicle;
//    }
//
//    public function getLocation() {
//        return FALSE;
//    }
//
//    public function getStartLocation() {
//        return $this->start_location;
//    }
//
//    public function getDescription() {
//        return $this->description;
//    }
//
//    public function addComponent(\StayTemplateComponent $component) {
//        return FALSE;
//    }
//
//    public function getAccomodations() {
//        return FALSE;
//    }
//
//    public function getActivities() {
//        return FALSE;
//    }
//
//    public function getEndDate() {
//        return FALSE;
//    }
//
//    public function getName() {
//        return $this->name;
//    }
//
//    public function getStartDate() {
//        
//    }
//
//    public function getTransports() {
//        
//    }
//
//    public function getType() {
//        
//    }
//
//    public function isComposite() {
//        
//    }
//
//    public function newItineraryBick() {
//        
//    }
//
//    public function removeComponent($id) {
//        
//    }
//
//    public function setDescription($description) {
//        
//    }
//
//    public function setEndDate($startDate) {
//        
//    }
//
//    public function setEndLocation($location) {
//        
//    }
//
//    public function setLocation($location) {
//        
//    }
//
//    public function setName($name) {
//        
//    }
//
//    public function setStartDate($endDate) {
//        
//    }
//
//    public function setStartLocation($location) {
//        
//    }

}

?>
