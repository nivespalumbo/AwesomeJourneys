<?php
include_once 'model/StayTemplate/StayTemplateLeaf.php';
include_once 'ActivityTemplate.php';

class Activity extends ActivityTemplate implements StayTemplateLeaf{
    private $idActivity;
    private $stayTemplateId;
    private $startDate;
    private $endDate;
    private $type;
    
    function __construct($idActivity, $startDate, $stayTemplateId, $endDate, $idTemplate, $name, $address, $expectedDuration, $location, $description) {
        parent::__construct($idTemplate, $name, $address, $expectedDuration, $location, $description);
        $this->idActivity = $idActivity;
        $this->stayTemplateId = $stayTemplateId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->type = ACTIVITY;
    }
    
    public function getIdActivity() {
        return $this->idActivity;
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
        return $this->type;
    }
    
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
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

    public function saveIntoDB() {
        parent::saveIntoDB();
    }




//    public function getVehicle() {
//        return FALSE;
//    }
//
//    public function getAccomodations() {
//        return FALSE;
//    }
//
//    public function getActivities() {
//        return $this;
//    }
//
//    public function getComposite() {
//        return FALSE;
//    }
//
//    public function getTransports() {
//        return FALSE;
//    }
//
//    public function getType() {
//        return $this->type;
//    }
//
//    public function setEndLocation($location) {
//        return FALSE;
//    }
//
//    public function setLocation($location) {
//        $this->location = $location;
//    }
//
//    public function setStartLocation($location) {
//        return FALSE;
//    }
//
//    public function addComponent(\StayTemplateComponent $component) {
//        return FALSE;
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
//    public function getName() {
//        return $this->name;
//    }
//
//    public function setDescription($description) {
//        $this->description = $description;
//    }
//
//    public function setName($name) {
//        $this->name = $name;
//    }
//    
//    public function getEndDate() {
//        return FALSE;
//    }
//
//    public function getStartDate() {
//        return $this->startDate;
//    }
//
//    public function setEndDate($endDate) {
//        return FALSE;
//    }
//
//    public function setStartDate($startDate) {
//        $this->startDate = $startDate;
//    }

}