<?php
include_once 'AccomodationTemplate.php';
include_once 'model/StayTemplate/StayTemplateLeaf.php';

class Accomodation extends AccomodationTemplate implements StayTemplateLeaf{
    private $id;
    private $stayTemplateId;
    private $numeroDisponibilita;
    private $startDate;
    private $duration;
    
    function __construct($id, $stayTemplateId, $numeroDisponibilita, $startDate, $duration, $idTemplate, $address, $type, $description, $category, $name, $link, $photo, $location) {
        parent::__construct($idTemplate, $address, $type, $description, $category, $name, $link, $photo, $location);
        $this->id = $id;
        $this->stayTemplateId = $stayTemplateId;
        $this->numeroDisponibilita = $numeroDisponibilita;
        $this->startDate = $startDate;
        $this->duration = $duration;
    }
    
    public function getId() {
        return $this->id;
    }
    public function getStayTemplateId(){
        return $this->stayTemplateId;
    }
    public function getNumeroDisponibilita() {
        return $this->numeroDisponibilita;
    }
    public function getStartDate() {
        return $this->startDate;
    }
    public function getDuration() {
        return $this->duration;
    }
    public function getType(){
        return ACCOMODATION;
    }

    public function setNumeroDisponibilita($numeroDisponibilita) {
        $this->numeroDisponibilita = $numeroDisponibilita;
    }
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
    public function setDuration($duration) {
        $this->duration = $duration;
    }
    
    public function saveIntoDB() {
        parent::saveIntoDB();
    }

    public function addComponent(\StayTemplateComponent $component) {
        return FALSE;
    }

    public function getAccomodations() {
        return $this;
    }

    public function getActivities() {
        return FALSE;
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

    public function getVehicle() {
        return FALSE;
    }
    
    public function getEndDate(){
        return FALSE;
    }
    public function setEndDate($endDate) {
        return FALSE;
    }
}

?>
