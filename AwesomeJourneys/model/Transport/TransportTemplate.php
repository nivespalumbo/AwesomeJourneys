<?php

class TransportTemplate implements Serializable{
    protected $idTemplate;
    protected $name;
    protected $description;
    protected $date;
    protected $vehicle;
    
    protected $locations;
    protected $start_hours;
    protected $durations;
    
    function __construct($idTemplate, $name, $description, $vehicle, Array $locations, Array $start_hours, Array $durations, $date = NULL) {
        $this->idTemplate = $idTemplate;
        $this->name = $name;
        $this->description = $description;
        if($date != NULL) { $this->date = new DateTime($date); }
        $this->vehicle = $vehicle;
        $this->locations = $locations;
        $this->start_hours = $start_hours;
        $this->durations = $durations;
    }
    
    public function serialize() {
        return serialize(
            array(
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'description' => $this->description,
                'date' => $this->date,
                'vehicle' => $this->vehicle,
                'locations' => $this->locations,
                'start_hours' => $this->start_hours,
                'durations' => $this->durations
            )
        );
    }

    public function unserialize($serialized) {
        $data = unserialize($serialized);
        
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        if($data['date'] != "") { $this->date = new DateTime($data['date']); }
        $this->vehicle = $data['vehicle'];
        $this->locations = $data['locations'];
        $this->start_hours = $data['start_hours'];
        $this->durations = $data['durations'];
    }
    
    public function getIdTemplate() {
        return $this->idTemplate;
    }
    public function getName() {
        return $this->name;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getVehicle() {
        return $this->vehicle;
    }
    public function getLocations() {
        return $this->locations;
    }
    public function getStart_hours() {
        return $this->start_hours;
    }
    public function getDurations() {
        return $this->durations;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setVehicle($vehicle) {
        $this->vehicle = $vehicle;
    }
    public function setLocations($locations) {
        $this->locations = $locations;
    }
    public function setStart_hours($start_hours) {
        $this->start_hours = $start_hours;
    }
    public function setDurations($durations) {
        $this->durations = $durations;
    }

    public function saveIntoDB(){
        
    }
}

?>
