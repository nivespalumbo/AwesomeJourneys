<?php
include_once 'TransportTemplate.php';

class Transport extends TransportTemplate implements StayTemplateLeaf{
    private $id;
    
    private $startDate;
    private $duration;
    private $startLocation;
    private $endLocation;
    
    function __construct($id, $startDate, $duration, $startLocation, $endLocation, $idTemplate, $name, $description, $vehicle) {
        parent::__construct($idTemplate, $name, $description, $vehicle);
        $this->id = $id;
        $this->startDate = $startDate;
        $this->duration = $duration;
        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
    }
    
    function serialize() {
        return serialize(
            array(
                'id' => $this->id,
                'startDate' => $this->startDate,
                'duration' => $this->duration,
                'startLocation' => $this->startLocation,
                'endLocation' => $this->endLocation,
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'description' => $this->description,
                'vehicle' => $this->vehicle,
            )
        );
    } 
    function unserialize($serialized) {
        $data = unserialize($serialized);
        
        $this->id = $data['id'];
        $this->startDate = $data['date'];
        $this->duration = $data['duration'];
        $this->startLocation = $data['startLocation'];
        $this->endLocation = $data['endLocation'];
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->vehicle = $data['vehicle'];
    }

    public function getId() { return $this->id; }
    public function getStartDate() { return $this->startDate; }
    public function getDuration() {
        return $this->duration;
    }
    public function getStartLocation() {
        return $this->locations[$this->startIndex];
    }
    public function getEndLocation() {
        return $this->locations[$this->endIndex];
    }
    public function getType() {
        return TRANSPORT;
    }
    
    public function setStartDate($startDate){ $this->startDate = $startDate; }
    public function setStartLocation($location) {
        $this->startIndex = array_search($location, $this->locations);
    }
    public function setEndLocation($location) {
        $this->endIndex = array_search($location, $this->locations);
    }
    public function setEndDate($endDate){ return FALSE; }
    
    
    
    public function saveIntoDB() {
        parent::saveIntoDB();
    }
    
    
    
    // STAY TEMPLATE LEAF
    
    public function addComponent(StayTemplateComponent $component) {
        return FALSE;
    }
    
    public function getComponentsOfType($type) {
        if($type == TRANSPORT){
            return $this;
        }
        else {
            return NULL;
        }
    }

    public function isComposite() {
        return FALSE;
    }

    public function removeComponent($id) {
        return FALSE;
    }

    


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
//    public function getEndLocation() {
//        return $this->locations[$this->endIndex];
//    }
//
//    public function getLocation() {
//        return FALSE;
//    }
//
//    public function getStartDate() {
//        return $this->date;
//    }
//
//    public function getStartLocation() {
//        return $this->locations[$this->startIndex];
//    }
//
//    public function getTransports() {
//        return $this;
//    }
//
//    public function getType() {
//        return TRANSPORT;
//    }
//
//    public function isComposite() {
//        return FALSE;
//    }
//
//    public function newItineraryBick() {
//        return FALSE;
//    }
//
//    public function removeComponent($id) {
//        return FALSE;
//    }
//
//    public function setEndDate($startDate) {
//        return FALSE;
//    }
//
//    public function setEndLocation($location) {
//        $this->endIndex = array_search($location, $this->locations);
//    }
//
//    public function setLocation($location) {
//        return FALSE;
//    }
//
//    public function setStartDate($endDate) {
//        $this->date = $endDate;
//    }
//
//    public function setStartLocation($location) {
//        $this->startIndex = array_search($location, $this->locations);
//    }
//
//    

    



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
