<?php
include_once 'StayTemplateLeaf.php';
include_once 'model/Enumerations/ComponentType.php';

class StayTemplateComposite implements StayTemplateComponent{
    private $id;
    private $name;
    private $description;
    
    private $startDate;
    private $endDate;
    
    private $startLocation; //contiene la località di partenza che coincide con la località della tappa rappresentata dal template
    private $endLocation; //contiene la località finale della tappa rappresentata dal template. Se il template ha una sola località endLocation = startLocation
    
    private $components; //array associativo che contiene i components
    
    function __construct($id) {
        $this->id = $id;
        $this->components = array();
    }
    
    public function __sleep() {
        return array("id", "name", "description", "startDate", "endDate", "startLocation", "endLocation", "components");
    }
    public function __wakeup() { }
    
    public function getId(){ return $this->id; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getType(){ return STAY_TEMPLATE; }
    public function getStartDate() { return $this->startDate; }
    public function getEndDate() { return $this->endDate; }
    public function getStartLocation(){ return $this->startLocation; }
    public function getEndLocation(){ return $this->endLocation; }
    
    public function setName($name) { $this->name = $name; }
    public function setDescription($description) { $this->description = $description; }
    public function setStartDate($startDate) { $this->startDate = $startDate; }
    public function setEndDate($endDate) { $this->endDate = $endDate; }
    public function setStartLocation($location){ $this->startLocation = $location; }
    public function setEndLocation($location){ $this->endLocation = $location; }
//    
    public function getActivities(){
        return $this->getComponentsOfType(ACTIVITY);
    }
    public function getAccomodations(){
        return $this->getComponentsOfType(ACCOMODATION);
    }
    public function getTransports(){
        return $this->getComponentsOfType(TRANSPORT);
//        $ris = array();
//        foreach($this->components as $component){
//            if($component->getType() == TRANSPORT){
//                $ris[$component->getId()] = $component;
//            } else if($component->getType() == TRANSFER_TEMPLATE){
//                array_merge($ris, $component->getTransports());
//            }
//        }
//        return $ris;
    }
    public function getCompositeTemplates(){
        $ris = array();
        foreach($this->components as $component){
            if($component->getType() == STAY_TEMPLATE || $component->getType() == TRANSFER_TEMPLATE){
                $ris[$component->getId()] = $component;
            }
        }
        return $ris;
    }
    
    private function getComponentsOfType($type){
        $ris = array();
        foreach($this->components as $component){
            if($component->getType() == $type){
                $ris[$component->getId()] = $component;
            }
        }
        return $ris;
    }
    
    public function addComponent(StayTemplateComponent $component){
        $this->components[$component->getId()] = $component;
    }
    
    public function removeComponent($idComponent){
        if(array_key_exists($idComponent, $this->components)){
            unset($this->components[$idComponent]);
        }
    }
    
    public function getComponent($idComponent){
        if(array_key_exists($idComponent, $this->components)){
            return $this->components[$idComponent];
        }
        return NULL;
    }
    
    public function isComposite() {
        return TRUE;
    }
    
//    public function addComponent(StayTemplateComponent $component, $id = -1) {
//        $ris = $this->insertComponent($component, $id);
//        if($ris != FALSE){
//            return $ris;
//        }else if($id != -1){
//            foreach($this->components as $c){
//                if($c->isComposite()){
//                    $ris = $c->addComponent($component, $id);
//                    if($ris != FALSE){
//                        break;
//                    }
//                }
//            }
//        }
//        if($ris == STAY_TEMPLATE){
//            $this->type = $ris;
//            return $ris;
//        }
//        return FALSE;
//        
//    }
    
//    private function getComponentsOfType($type){
//        $ris = array();
//        foreach($this->components as $component){
//            if($component->getType() == $type){
//                $ris[$component->getId()] = $component;
//            }else if($type == TRANSPORT || $type == TRANSFER_TEMPLATE){
//                array_merge($ris, $component->getTransports());
//            }
//        }
//        return $ris;
//    }
    
//    public function getActivities(){
//        return $this->getComponentsOfType(ACTIVITY);
//    }
//
//    public function getAccomodations(){
//        return $this->getComponentsOfType(ACCOMODATION);
//    }
    
//    private function getTransportInArray($transports){
//        foreach($this->components as $component){
//            if($component->getType() == TRANSFER){
//                $transports[$component->getId()] = $component;
//            }else if($component->getType() == TRANSFER_TEMPLATE){
//                $component->getTransportInArray($transports);
//            }
//        }
//        return $transports;
//    }
//
//    public function getTransports(){
//        if($this->type == TRANSFER_TEMPLATE){
//            return $this->getTransportInArray(array());
//        }
//        return $this->getComponentsOfType(TRANSPORT);
//    }
    
//    public function isComposite(){
//        return TRUE;
//    }
//
//    public function newItineraryBick(){
//        if($this->type == TRANSFER_TEMPLATE){
//            return new Transfer(-1, $this);
//        }
//        $stay = new Stay(-1, $this);
//        
//        $stayChildren = array();
//        foreach ($this->components as $component){
//            if($component->getType() == STAY_TEMPLATE){
//                array_push($stayChildren, $component->newStay());
//            }
//        }
//        $stay->setStayChildren($stayChildren);
//        
//        return $stay;
//    }
//    private function insertComponent(StayTemplateComponent $component, $id){
//        if($id == -1 || $this->id == $id){
//            $this->components[$component->getId()] = $component;
//            if($component->getType() == ACCOMODATION || $component->getType() == STAY_TEMPLATE){
//                $this->type = STAY_TEMPLATE;
//                return $this->type;
//            }  
//        }
//        return FALSE;
//    }
//    
//    public function removeComponent($id) {
//        
//    }
}
