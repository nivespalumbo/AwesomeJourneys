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
        $this->startDate = $data['startDate'];
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
    public function getDuration() { return $this->duration; }
    public function getStartLocation() { return $this->startLocation; }
    public function getEndLocation() { return $this->endLocation; }
    public function getType() { return TRANSPORT; }
    
    public function setStartDate($startDate){ $this->startDate = $startDate; }
    public function setStartLocation($location) { $this->startLocation = $location; }
    public function setEndLocation($location) { $this->endLocation = $location; }
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
}

?>
