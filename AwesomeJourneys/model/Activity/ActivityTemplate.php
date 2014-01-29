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
    
    private $availableFrom;
    private $availableTo;
    
    function __construct($id, $name, $address, $expectedDuration, $location, $description) {
        $this->idTemplate = $id;
        $this->name = $name;
        $this->address = $address;
        $this->expectedDuration = $expectedDuration;
        $this->location = $location;
        $this->description = $description;
    }
        
    public function serialize() {
        return serialize(
            array(
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'address' => $this->address,
                'expectedDuration' => $this->expectedDuration,
                'location' => $this->location,
                'description' => $this->description,
                'availableFrom' => $this->availableFrom,
                'availableTo' => $this->availableTo
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
        $this->availableFrom = $data['availableFrom'];
        $this->availableTo = $data['availableTo'];
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
    public function getAvailableFrom() {
        return $this->availableFrom;
    }
    public function getAvailableTo() {
        return $this->availableTo;
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
    public function setAvailableFrom($startDate) {
        $this->availableFrom = $startDate;
    }
    public function setAvailableTo($endDate) {
        $this->availableTo = $endDate;
    }

    
    public function saveIntoDB(){
        
    }
}
