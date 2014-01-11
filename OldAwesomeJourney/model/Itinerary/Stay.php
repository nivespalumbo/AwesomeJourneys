<?php
include_once 'ItineraryBrickLeaf.php';

class Stay implements ItineraryBrickLeaf, StayTemplateComponent{
    private $stayId;
    private $options;
    private $startLocation;
    private $endLocation;
    private $attivita;//array contenete tutte le attivita
    private $accomodations;//array contenente tutti gli accomodation
    private $trasporti;//array contenente tutti i trasporti

    public function __construct($stayId) {
        $this->stayId = $stayId;
        $this->options = array();
        $this->attivita = array();
        $this->accomodations = array();
        $this->trasporti = array();
    }
    
    public function setLocation($startLocation, $endLocation){
        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
    }
    
    public function configureStayParameter($optId, $valId){
        //$this->options[$optId] = $valId;
    }
    
    public function getActivity(){
        return $this->attivita;
    }
    
    public function ricercaTappa($stayId) {
        if($this->stayId != $stayId)
            return FALSE;
        return $this;
    }
    
    public function manageActivityInStay($stayId){
        if($stayId != $this->stayId){
            return FALSE;
        }
        
        return $this->attivita;
    }
    
    public function addActivity($activity) {
        $this->attivita[$activity->getId()] = $activity;
    }
    
    public function addTransport($transport) {
        $this->transportComponents[$transport->getId()] = $transport;
    }
    
    public function addAccomodation($accomodation) {
        $this->accomodationComponents[$accomodation->getId()] = $accomodation;
        return TRUE;
    }
    
    public function removeActivity($idList){
        foreach($idList as $id){
            if(isset($this->attivita[$id])){
                unset($this->attivita[$id]);
            }
        }
    }

    public function get_category() {
        
    }

    public function get_creator() {
        
    }

    public function get_description() {
        
    }

    public function get_name() {
        
    }

    public function get_photo() {
        
    }

    public function get_tag() {
        
    }

    public function visualizza_tappe() {
        $ris = array();
        $ris[$this->stayId] = $this;
        return $ris;
    }

    public function getId() {
        return $this->stayId;
    }

    public function selectActivity($activityIdList, $stayId) {
        if($this->stayId != $stayId)
            return FALSE;
        $ris = array();
        foreach($activityIdList as $act){
            if(isset($this->attivita[$act->getId()])){
                $ris[$act->getId()] = $act;
            }    
        }
        return $ris;
    }

    public function getAccomodation() {
        return $this->accomodations;
    }

    public function getTransport() {
        return $this->trasporti;
    }

    public function getLocation() {
        if($this->startLocation == $this->endLocation)
            return $this->startLocation;
        return FALSE;
    }

    public function getStay($stayId) {
        if($this->stayId != $stayId){
            return FALSE;
        }else{
            return $this;
        }
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
