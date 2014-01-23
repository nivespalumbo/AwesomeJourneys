<?php
include_once 'model/StayTemplate/StayTemplateLeaf.php';
include_once 'ActivityTemplate.php';

class Activity extends ActivityTemplate implements StayTemplateLeaf{
    private $id;
    private $compositeId;
    
    private $startDate;
    private $endDate;
    
    function __construct($idActivity, $compositeId, $idTemplate, $name, $address, $expectedDuration, $location, $description) {
        parent::__construct($idTemplate, $name, $address, $expectedDuration, $location, $description);
        $this->id = $idActivity;
        $this->compositeId = $compositeId;
    }
    
    function serialize(){
        return serialize(
            array(
                'id' => $this->id,
                'compositeId' => $this->compositeId,
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
        $this->compositeId = $data['compositeId'];
        $this->startDate = $data['startDate'];
        $this->endDate = $data['endDate'];
    }
        
    public function getId() {
        return $this->id;
    }
    public function getCompositeId() {
        return $this->compositeId;
    }
    public function getStartDate() {
        return $this->startDate;
    }
    public function getEndDate() {
        return $this->endDate;
    }
    public function getStartLocation() {
        return $this->location;
    }
    public function getEndLocation() {
        return $this->location;
    }
    public function getType() {
        return ACTIVITY;
    }
    public function getDuration() {
        return date_diff($this->endDate, $this->startDate, true);
    }
    
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }
    public function setStartLocation($location) {
        $this->location = $location;
    }
    public function setEndLocation($location) {
        $this->location = $location;
    }
    
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
        return $this;
    }

    public function getCompositeTemplates() {
        return FALSE;
    }

    public function getTransports() {
        return FALSE;
    }

    public function isComposite() {
        return FALSE;
    }

    public function removeComponent($id) {
        return FALSE;
    }
}