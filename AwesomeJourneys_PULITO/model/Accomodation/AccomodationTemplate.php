<?php

/**
 * Description of AccomodationTemplate
 *
 * @author Nives
 */
class AccomodationTemplate implements Serializable{
    protected $idTemplate;
    protected $name;
    protected $description;
    protected $location;
    protected $address;
    
    function __construct($idTemplate, $name, $description, $location, $address) {
        $this->idTemplate = $idTemplate;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->address = $address;
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

    public function getLocation() {
        return $this->location;
    }

    public function getAddress() {
        return $this->address;
    }

    public function serialize() {
        return serialize(
            array(
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'description' => $this->description,
                'location' => $this->location,
                'address' => $this->address
            )
        );
    }

    public function unserialize($serialized) {
        $data = unserialize($serialized);
        
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->location = $data['location'];
        $this->address = $data['address'];
    }


}
