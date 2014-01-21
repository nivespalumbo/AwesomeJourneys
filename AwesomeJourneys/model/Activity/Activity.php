<?php
include_once 'model/StayTemplate/StayTemplateLeaf.php';
include_once 'ActivityTemplate.php';

class Activity extends ActivityTemplate implements StayTemplateLeaf{
    private $id;
    private $stayTemplateId;
    private $startDate;
    private $endDate;
    
    function __construct($idActivity, $startDate, $stayTemplateId, $endDate, $idTemplate, $name, $address, $expectedDuration, $location, $description) {
        parent::__construct($idTemplate, $name, $address, $expectedDuration, $location, $description);
        $this->id = $idActivity;
        $this->stayTemplateId = $stayTemplateId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    function serialize(){
        return serialize(
            array(
                'id' => $this->id,
                'stayTemplateId' => $this->stayTemplateId,
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'address' => $this->address,
                'expectedDuration' => $this->expectedDuration,
                'location' => $this->location,
                'description' => $this->description
            )
        );
    }
    
    function unserialize($data) {
        $data = unserialize($data);
        
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->address = $data['address'];
        $this->description = $data['description'];
        $this->expectedDuration = $data['expectedDuration'];
        $this->location = $data['location'];
        $this->id = $data['id'];
        $this->stayTemplateId = $data['stayTemplateId'];
        $this->startDate = $data['startDate'];
        $this->endDate = $data['endDate'];
    }
    
//    public function __sleep() {
//        return array("id", "stayTemplateId", "startDate", "endDate");
//    }
//
//    public function __wakeup() {
//        
//    }

    
    public function getId() {
        return $this->id;
    }
    public function getStayTemplateId() {
        return $this->stayTemplateId;
    }
    public function getStartDate() {
        return $this->startDate;
    }
    public function getEndDate() {
        return $this->endDate;
    }
    public function getType() {
        return ACTIVITY;
    }
    
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
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
        return $this;
    }

    public function getEndLocation() {
        return FALSE;
    }

    public function getStartLocation() {
        return FALSE;
    }

    public function getTransports() {
        return FALSE;
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

    public function setEndLocation($location) {
        return FALSE;
    }

    public function setStartLocation($location) {
        return FALSE;
    }

    public function getDuration() {
        return FALSE;
    }

    public function getVehicle() {
        return FALSE;
    }
}