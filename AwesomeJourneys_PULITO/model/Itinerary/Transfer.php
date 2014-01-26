<?php

/**
 * Description of Transfer
 *
 * @author Nives
 */
class Transfer implements ItineraryBrick{
    private $id;
    private $startLocation;
    private $endLocation;
    private $templateId;
    
    private $selectedTransport;
    
    function __construct($id, $startLocation, $endLocation, $templateId) {
        $this->id = $id;
        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
        $this->templateId = $templateId;
        
        $this->selectedTransport = NULL;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }

    public function getStartLocation() {
        return $this->startLocation;
    }

    public function getEndLocation() {
        return $this->endLocation;
    }
    
    public function getType(){
        return TRANSFER;
    }

    public function getTemplateId() {
        return $this->templateId;
    }

    public function setStartLocation($startLocation) {
        $this->startLocation = $startLocation;
    }

    public function setEndLocation($endLocation) {
        $this->endLocation = $endLocation;
    }
    
    public function addActivity(Activity $a){
        return FALSE;
    }
    
    public function addAccomodation(Accomodation $a){
        return FALSE;
    }
    
    public function addTransport(Transport $t){
        $this->selectedTransport = $t;
    }

    public function __sleep() {
        return array('id', 'startLocation', 'endLocation', 'templateId');
    }

    public function __wakeup() {
        
    }


}
