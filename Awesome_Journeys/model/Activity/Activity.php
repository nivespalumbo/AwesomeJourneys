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
    
    public function __construct($id, $stayTemplateId, $expected_duration, $location, $description, $name, $start_date) {
        $this->id = $id;
        $this->stayTempalateId = $stayTemplateId;
        $this->expected_duration = $expected_duration;
        $this->location = $location;
        $this->description = $description;
        $this->name = $name;
        $this->start_date = $start_date;
    }
    
    public function getTemplateId(){
        return $this->stayTempalateId;
    }
    
    public function getLocation(){
        return $this->location;
    }
    
    public function getDuration(){
        return $this->duration;
    }
    
    public function getDescription(){
        return $this->description;
    }

    public function getId() {
        return $this->id;
    }

    public function getActivity() {
        $activity = array();
        $activity[] = $this;
        return $activity;
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
}