<?php
include_once 'model/StayTemplate/StayTemplateLeaf.php';

class Activity implements StayTemplateLeaf{
    private $id;
    private $location;
    private $name;
    private $expected_duration;
    private $description;
    private $start_date;
    private $stayTempalateId;
    private $endDate;
    private $type;
    
    public function __construct($id, $stayTemplateId, $expected_duration, $location, $description, $name, $start_date) {
        $this->id = $id;
        $this->stayTempalateId = $stayTemplateId;
        $this->expected_duration = $expected_duration;
        $this->location = $location;
        $this->description = $description;
        $this->name = $name;
        $this->start_date = $start_date;
        $this->type = ACTIVITY;
    }
    
    public function getLocation(){
        return $this->location;
    }
    
    public function getDuration(){
        return $this->expected_duration;
    }
    
    public function getDescription(){
        return $this->description;
    }

    public function getId() {
        return $this->id;
    }

    public function getEndLocation() {
        return FALSE;
    }

    public function getStartLocation() {
        return FALSE;
    }

    public function getVehicle() {
        return FALSE;
    }

    public function getAccomodation() {
        return FALSE;
    }

    public function getActivities() {
        return $this;
    }

    public function getComposite() {
        return FALSE;
    }

    public function getTransports() {
        return FALSE;
    }

    public function getType() {
        return $this->type;
    }

    public function setEndLocation($location) {
        return FALSE;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function setStartLocation($location) {
        return FALSE;
    }

    public function addComponent(\StayTemplateComponent $component) {
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

    public function getName() {
        return $this->name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    public function getEndDate() {
        return FALSE;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setEndDate($endDate) {
        return FALSE;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

}