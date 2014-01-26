<?php

/**
 * Description of StayTemplateComposite
 *
 * @author Nives
 */
class StayTemplateComposite implements StayTemplateComponent{
    private $id;
    private $name;
    private $description;
    private $startLocation;
    private $endLocation;
    
    private $components;
    
    function __construct($id) {
        $this->id = $id;
        $this->components = array();
    }
    
    function getId(){ return $this->id; }
    function getType() { return STAY_TEMPLATE; }
    
    public function getStartLocation() {
        return $this->startLocation;
    }

    public function getEndLocation() {
        return $this->endLocation;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStartLocation($startLocation) {
        $this->startLocation = $startLocation;
    }

    public function setEndLocation($endLocation) {
        $this->endLocation = $endLocation;
    }
     
    public function addComponent($key, \StayTemplateComponent $object) {
        $this->components[$key] = $object;
    }

    public function getComponent($key) {
        if(array_key_exists($key, $this->components)){
            return $this->components[$key];
        }
        return NULL;
    }

    public function getComponentsOfType($type) {
        $ris = array();
        foreach($this->components as $key => $component){
            if($component->getType() == $type){
                $ris[$key] = $component;
            }
        }
        return $ris;
    }

    public function removeComponent($key) {
        if(array_key_exists($key, $this->components)){
            unset($this->components[$key]);
        }
    }

    public function __sleep() {
        return array('id', 'startLocation', 'endLocation', 'components');
    }
    public function __wakeup() {
        
    }


}
