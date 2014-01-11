<?php
include_once 'StayTemplateLeaf.php';

class StayTemplateComposite implements StayTemplateComponent{
    private $activityComponents;
    private $accomodationComponents;
    private $transportComponents;
    private $id;
    private $startLocation;
    private $endLocation;
    
    function __construct($id) {
        $this->id = $id;
        $this->transportComponents = array();
        $this->accomodationComponents = array();
        $this->activityComponents = array();
    }
    
    public function setLocation($startLocation, $endLocation){
        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
    }

    public function addActivity($component) {
        $this->activityComponents[$component->getId()] = $component;
        
        /*$activityLocation = $component->getLocation();
        foreach($this->accomodationComponents as $accomodation){
            if($accomodation->getLocation() == $activityLocation){
                $this->activityComponents[$component->getId()] = $component;
                return TRUE;
            }
        }
        
        return FALSE;*/
    }
    
    public function addTransport($component) {
        $this->transportComponents[$component->getId()] = $component;
        
        /*if($component->getLocation() == $this->location){
            $this->transportComponents[$component->getId()] = $component;
            return TRUE;
        }
        return FALSE;*/
    }
    
    public function addAccomodation($component) {
        $this->accomodationComponents[$component->getId()] = $component;
    }

    public function removeTransport($id) {
        if(!isset($this->transportComponents[$id])){
            return FALSE;
        }
        unset($this->transportComponents[$id]);
        return TRUE;
    }
    
    public function removeAccomodation($id) {
        if(!isset($this->accomodationComponents[$id])){
            return FALSE;
        }
        unset($this->accomodationComponents[$id]);
        return TRUE;
    }
    
    public function removeActivity($id) {
        if(!isset($this->accomodationComponents[$id])){
            return FALSE;
        }
        unset($this->accomodationComponents[$id]);
        return TRUE;
    }

    public function getTemplateId() {
        return $this->id;
    }
    
    public function getActivity(){
        $ris = array();
        foreach($this->activityComponents as $component){
            $activitys = $component->getActivity();
            foreach($activitys as $activity){
                $ris[$activity->getId()] = $activity;
            }
        }
        return $ris;
    }

    public function getAccomodation() {
        $ris = array();
        foreach($this->accomodationComponents as $component){
            $accomodations = $component->getAccomodation();
            foreach($accomodations as $accomodation){
                $ris[$accomodation->getId()] = $accomodation;
            }
        }
        return $ris;
    }

    public function getTransport() {
        $ris = array();
        foreach($this->transportComponents as $component){
            $transports = $component->getAccomodation();
            foreach($transports as $transport){
                $ris[$transport->getId()] = $transport;
            }
        }
        return $ris;
    }

    public function getLocation() {
        if($this->startLocation == $this->endLocation)
            return $this->startLocation;
        return FALSE;
    }

    public function getEndLocation() {
        if($this->startLocation != $this->endLocation)
            return $this->endLocation;
        return FALSE;
    }

    public function getStartLocation() {
       if($this->startLocation != $this->endLocation)
            return $this->startLocation;
       return FALSE;
    }
}

?>
