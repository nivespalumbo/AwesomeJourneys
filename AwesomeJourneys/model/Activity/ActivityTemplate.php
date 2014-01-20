<?php
/**
 * Description of ActivityTemplate
 *
 * @author Nives
 */
class ActivityTemplate {
    private $idTemplate;
    private $name;
    private $address;
    private $expectedDuration;
    private $location;
    private $description;
    
    function __construct($id, $name, $address, $expectedDuration, $location, $description) {
        $this->idTemplate = $id;
        $this->name = $name;
        $this->address = $address;
        $this->expectedDuration = $expectedDuration;
        $this->location = $location;
        $this->description = $description;
    }

    public function getId() {
        return $this->idTemplate;
    }
    public function getName() {
        return $this->name;
    }
    public function getAddress() {
        return $this->address;
    }
    public function getExpectedDuration() {
        return $this->expectedDuration;
    }
    public function getLocation() {
        return $this->location;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function setAddress($address) {
        $this->address = $address;
    }
    public function setExpectedDuration($expectedDuration) {
        $this->expectedDuration = $expectedDuration;
    }
    public function setLocation($location) {
        $this->location = $location;
    }
    public function setDescription($description) {
        $this->description = $description;
    }

    public function saveIntoDB(){
        
    }
}
