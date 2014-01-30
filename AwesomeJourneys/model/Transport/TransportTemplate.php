<?php

class TransportTemplate implements Serializable{
    protected $idTemplate;
    protected $name;
    protected $description;
    protected $vehicle;
    
    function __construct($idTemplate, $name, $description, $vehicle) {
        $this->idTemplate = $idTemplate;
        $this->name = $name;
        $this->description = $description;
        $this->vehicle = $vehicle;
    }
    
    public function serialize() {
        return serialize(
            array(
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'description' => $this->description,
                'vehicle' => $this->vehicle
            )
        );
    }

    public function unserialize($serialized) {
        $data = unserialize($serialized);
        
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->vehicle = $data['vehicle'];
    }
    
    public function getId() {
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

    public function setName($name) {
        $this->name = $name;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setVehicle($vehicle) {
        $this->vehicle = $vehicle;
    }

    public function saveIntoDB(){
        
    }
}

?>
