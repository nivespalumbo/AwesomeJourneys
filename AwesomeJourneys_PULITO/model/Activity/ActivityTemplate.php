<?php

/**
 * Description of ActivityTemplate
 *
 * @author Nives
 */
class ActivityTemplate implements Serializable{
    protected $idTemplate;
    protected $name;
    protected $description;
    protected $location;
    protected $address;
    
    protected $availableFrom;
    protected $availableTo;
    
    function __construct($idTemplate, $name, $description, $location, $address, $availableFrom, $availableTo) {
        $this->idTemplate = $idTemplate;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->address = $address;
        $this->availableFrom = $availableFrom;
        $this->availableTo = $availableTo;
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

    public function getLocation() {
        return $this->location;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getAvailableFrom() {
        return $this->availableFrom;
    }

    public function getAvailableTo() {
        return $this->availableTo;
    }

        
    public function serialize() {
        return serialize(
            array(
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'description' => $this->description,
                'location' => $this->location,
                'address' => $this->address,
                'availableFrom' => $this->availableFrom,
                'availableTo' => $this->availableTo
            )
        );
    }
    public function unserialize($data) {
        $data = unserialize($data);
        
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->location = $data['location'];
        $this->address = $data['address'];
        $this->availableFrom = $data['availableFrom'];
        $this->availableTo = $data['availableTo'];
    }

}
