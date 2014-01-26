<?php

include_once 'AccomodationTemplate.php';
include_once 'model/StayTemplate/StayTemplateLeaf.php';

/**
 * Description of Accomodation
 *
 * @author Nives
 */
class Accomodation extends AccomodationTemplate implements StayTemplateLeaf {
    private $id;
    private $accomodationType;
    
    function __construct($id, $type, $idTemplate, $name, $description, $location, $address) {
        parent::__construct($idTemplate, $name, $description, $location, $address);
        $this->id = $id;
        $this->accomodationType = $type;
    }
    
    public function addComponent($key, \StayTemplateComponent $object) {
        return FALSE;
    }

    public function getComponent($key) {
        return FALSE;
    }

    public function getComponentsOfType($type) {
        return FALSE;
    }

    public function getId() {
        return $this->id;
    }

    public function getType() {
        return ACCOMODATION;
    }

    public function removeComponent($key) {
        return FALSE;
    }

    public function serialize() {
        return serialize(
            array(
                'id' => $this->id,
                'accomodationType' => $this->accomodationType,
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
        
        $this->id = $data['id'];
        $this->accomodationType = $data['accomodationType'];
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->location = $data['location'];
        $this->address = $data['address'];
    }


}
