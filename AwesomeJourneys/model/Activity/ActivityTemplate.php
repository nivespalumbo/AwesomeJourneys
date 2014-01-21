<?php
/**
 * Description of ActivityTemplate
 *
 * @author Nives
 */
class ActivityTemplate implements Serializable{
    protected $idTemplate;
    protected $name;
    protected $address;
    protected $expectedDuration;
    protected $location;
    protected $description;
    
    function __construct($id, $name, $address, $expectedDuration, $location, $description) {
        $this->idTemplate = $id;
        $this->name = $name;
        $this->address = $address;
        $this->expectedDuration = $expectedDuration;
        $this->location = $location;
        $this->description = $description;
    }
    
//    public function __sleep() {
//        return array( "idTemplate", "name", "address", "expectedDuration", "location", "description");
//    }
//
//    public function __wakeup() {
//        
//    }
    
    public function serialize() {
        return serialize(
            array(
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'address' => $this->address,
                'expectedDuration' => $this->expectedDuration,
                'location' => $this->location,
                'description' => $this->description
            )
        );
    }
    
    public function unserialize($data) {
        $data = unserialize($data);
        
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->address = $data['address'];
        $this->description = $data['description'];
        $this->expectedDuration = $data['expectedDuration'];
        $this->location = $data['location'];
    }

    public function getIdTemplate() {
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
