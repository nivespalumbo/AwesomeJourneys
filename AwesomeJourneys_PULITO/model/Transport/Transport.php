<?php

include_once 'TransportTemplate.php';
include_once 'model/StayTemplate/StayTemplateLeaf.php';

/**
 * Description of Transport
 *
 * @author Nives
 */
class Transport extends TransportTemplate implements StayTemplateLeaf {
    private $id;
    private $startLocation;
    private $endLocation;
    private $vehicle;
    private $duration;
    
    public function __construct($id, $startLocation, $endLocation, $vehicle, $duration, $idTemplate) {
        parent::__construct($idTemplate);
        $this->id = $id;
        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
        $this->vehicle = $vehicle;
        $this->duration = $duration;
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

    public function getType() {
        return TRANSPORT;
    }

    public function removeComponent($key) {
        return FALSE;
    }

    public function getLocation() {
        return $this->startLocation;
    }

    public function getId() {
        return $this->id;
    }

    public function serialize() {
        return serialize(
            array(
                'id' => $this->id,
                'startLocation' => $this->startLocation
            )
        );
    }

    public function unserialize($serialized) {
        parent::unserialize($serialized);
    }

}
