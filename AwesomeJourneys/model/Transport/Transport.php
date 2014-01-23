<?php
include_once 'TransportTemplate.php';

class Transport extends TransportTemplate implements StayTemplateLeaf{
    private $id;
    private $compositeId;
    
    private $startIndex;
    private $endIndex;
    
    private $startDate;
    
    function __construct($id, $startIndex, $endIndex, $startDate, $idTemplate, $name, $description, $vehicle, $locations, $start_hours, $durations, $data) {
        parent::__construct($idTemplate, $name, $description, $vehicle, $locations, $start_hours, $durations, $data);
        $this->id = $id;
        $this->startIndex = $startIndex;
        $this->endIndex = $endIndex;
        $this->startDate = $startDate;
    }
    
    function serialize() {
        return serialize(
            array(
                'id' => $this->id,
                'compositeId' => $this->compositeId,
                'startIndex' => $this->startIndex,
                'endIndex' => $this->endIndex,
                'date' => $this->startDate,
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'description' => $this->description,
                'vehicle' => $this->vehicle,
                'locations' => $this->locations,
                'start_hours' => $this->start_hours,
                'durations' => $this->durations,
                'date' => $this->date
            )
        );
    } 
    function unserialize($serialized) {
        $data = unserialize($serialized);
        
        $this->id = $data['id'];
        $this->compositeId = $data['compositeId'];
        $this->startIndex = $data['startIndex'];
        $this->endIndex = $data['endIndex'];
        $this->startDate = $data['date'];
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->vehicle = $data['vehicle'];
        $this->locations = $data['locations'];
        $this->start_hours = $data['start_hours'];
        $this->durations = $data['durations'];
        if($data['date'] != "") { $this->date = new DateTime($data['date']); }
    }

    public function getId() { return $this->id; }
    public function getStartDate() { return $this->startDate; }
    public function getDuration() {
        return array_sum(array_slice($this->durations, $this->startIndex, $this->endIndex - $this->startIndex));
    }
    public function getEndDate() {
        return date_add($this->startDate, $this->getDuration());
    }
    public function getStartLocation() {
        return $this->locations[$this->startIndex];
    }
    public function getEndLocation() {
        return $this->locations[$this->endIndex];
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
    
    
    
    public function addComponent(StayTemplateComponent $component) {
        return FALSE;
    }

    public function getAccomodations() {
        return FALSE;
    }

    public function getActivities() {
        return FALSE;
    }

    public function getCompositeTemplates() {
        return FALSE;
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
