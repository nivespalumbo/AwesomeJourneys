<?php
include_once 'AccomodationTemplate.php';
include_once 'model/StayTemplate/StayTemplateLeaf.php';

class Accomodation extends AccomodationTemplate implements StayTemplateLeaf{
    private $id;
    private $compositeId;
    private $numeroDisponibilita;
    
    private $startDate;
    private $duration;
    
    function __construct($id, $compositeId, $numeroDisponibilita, $startDate, $duration, $idTemplate, $address, $type, $description, $category, $name, $link, $photo, $location) {
        parent::__construct($idTemplate, $address, $type, $description, $category, $name, $link, $photo, $location);
        $this->id = $id;
        $this->compositeId = $compositeId;
        $this->numeroDisponibilita = $numeroDisponibilita;
        
        $this->startDate = $startDate;
        $this->duration = $duration;
    }
    
    function serialize() {
        return serialize(
            array(
                'id' => $this->id,
                'compositeId' => $this->compositeId,
                'numeroDisponibilita' => $this->numeroDisponibilita,
                'startDate' => $this->startDate,
                'duration' => $this->duration,
                'idTemplate' => $this->idTemplate,
                'address' => $this->address,
                'accomodationType' => $this->accomodationType,
                'description' => $this->description,
                'category' => $this->category,
                'name' => $this->name,
                'link' => $this->link,
                'photo' => $this->photo,
                'location' => $this->location,
            )
        );
    }   
    function unserialize($serialized) {
        $data = unserialize($serialized);
        
        $this->id = $data['id'];
        $this->compositeId = $data['compositeId'];
        $this->numeroDisponibilita = $data['numeroDisponibilita'];
        $this->startDate = $data['startDate'];
        $this->duration = $data['duration'];
        $this->idTemplate = $data['idTemplate'];
        $this->address = $data['address'];
        $this->accomodationType = $data['accomodationType'];
        $this->description = $data['description'];
        $this->category = $data['category'];
        $this->name = $data['name'];
        $this->link = $data['link'];
        $this->photo = $data['photo'];
        $this->location = $data['location'];
    }

    public function getId() {
        return $this->id;
    }
    public function getCompositeId(){
        return $this->compositeId;
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
    public function getEndDate() {
        return date_add($this->startDate, $this->duration);
    }
    public function getStartLocation() {
        return $this->location;
    }
    public function getEndLocation() {
        return $this->location;
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
    public function setEndDate($endDate) {
        $this->duration = date_diff($endDate, $this->startDate, true);
    }
    public function setStartLocation($location) {
        $this->location = $location;
    }
    public function setEndLocation($location) {
        $this->location = $location;
    }
    public function setDuration($duration) {
        $this->duration = $duration;
    }
    
    public function saveIntoDB() {
        parent::saveIntoDB();
    }
    
    public function addComponent(StayTemplateComponent $component) {
        return FALSE;
    }

    public function getAccomodations() {
        return $this;
    }

    public function getActivities() {
        return FALSE;
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
?>