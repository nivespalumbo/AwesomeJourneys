<?php

include_once 'ActivityTemplate.php';
include_once 'model/StayTemplate/StayTemplateLeaf.php';
/**
 * Description of Activity
 *
 * @author Nives
 */
class Activity extends ActivityTemplate implements StayTemplateLeaf{
    private $id;
    private $start;
    private $end;
    
    public function __construct($id, $start, $end, $idTemplate, $name, $description, $location, $address, $availableFrom, $availableTo) {
        parent::__construct($idTemplate, $name, $description, $location, $address, $availableFrom, $availableTo);
        $this->id = $id;
        $this->start = $start;
        $this->end = $end;
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
        return ACTIVITY;
    }

    public function removeComponent($key) {
        return FALSE;
    }

    public function serialize() {
        return serialize(
            array(
                'id' => $this->id,
                'start' => $this->start,
                'end' => $this->end,
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
        
        $this->id = $data['id'];
        $this->start = $data['start'];
        $this->end = $data['end'];
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->location = $data['location'];
        $this->address = $data['address'];
        $this->availableFrom = $data['availableFrom'];
        $this->availableTo = $data['availableTo'];
    }


}
