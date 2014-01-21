<?php
include_once 'StayTemplateComponent.php';

/**
 * Description of TransferTemplate
 *
 * @author anto
 */
class TransferTemplateComposite implements StayTemplateComponent{
    private $id;
    private $name;
    private $description;
    
    private $startLocation;
    private $endLocation;
    
    private $startDate;
    private $endDate;
    
    private $components;
    
    function __construct($id) {
        $this->id = $id;
        $this->components = array();
    }
    
    public function __sleep() {
        return array("id", "name", "description", "startLocation", "endLocation", "startDate", "endDate", "components");
    }

    public function __wakeup() {
        
    }

    
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getType() {
        return TRANSFER_TEMPLATE;
    }
    public function getStartLocation() {
        return $this->startLocation;
    }
    public function getEndLocation() {
        return $this->endLocation;
    }
    public function getStartDate() {
        return $this->startDate;
    }
    public function getEndDate() {
        return $this->endDate;
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
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    public function addComponent(StayTemplateComponent $component) {
        if($component->getType() == TRANSFER || $component->getType() == TRANSFER_TEMPLATE){
            $this->components[$component->getId()] = $component;
        }
    }

    public function getAccomodations() {
        return FALSE;
    }

    public function getActivities() {
        return FALSE;
    }

    public function getTransports() {
        return $this->getTransportInArray();
    }
    
    private function getTransportInArray(){
        $array = array();
        foreach($this->components as $component){
            if($component->getType() == TRANSFER){
                $array[$component->getId()] = $component;
            } else if($component->getType() == TRANSFER_TEMPLATE){
                array_merge($array, $component->getTransportInArray());
            }
        }
        return $array;
    }

    public function isComposite() {
        return TRUE;
    }

    public function newItineraryBick() {
        
    }

    public function removeComponent($id) {
        
    }





//    function __construct($id) {
//        $this->id = $id;
//        $this->type = TRANSFER_TEMPLATE;
//        $this->components = array();
//    }
//    
//    public function addComponent(StayTemplateComponent $component) {
//        
//    }
//
//    public function getAccomodation() {
//        return FALSE;
//    }
//
//    public function getActivities() {
//        return FALSE;
//    }
//
//    public function getComposite() {
//        return FALSE;
//    }
//    
//    private function getTransportInArray($transports){
//        
//    }
//
//    public function getTransports() {
//        
//    }
//    
//    public function newItineraryBick() {
//        return new Transfer(-1, $this);
//    }

}
