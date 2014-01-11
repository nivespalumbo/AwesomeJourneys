<?php
include_once 'ItineraryBrickLeaf.php';
include_once 'model/StayTemplate/StayTemplateComponent.php';

class Transfer implements ItineraryBrickLeaf, StayTemplateComponent{
    private $stayId;
    private $options;
    private $startLocation;
    private $endLocation;
    private $attivita;//array contenete tutte le attivita
    private $trasporti;//array contenente tutti i trasporti


    public function __construct($stayId, $template) {
        $this->stayId = $stayId;
        $this->options = array();
        $this->trasporti = array();
    }
    
    public function setLocation($startLocation, $endLocation){
        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
    }
    
    public function configureStayParameter($optId, $valId){
        //$this->options[$optId] = $valId;
    }
    
    public function manageActivityInStay($listActivityId){
        
    }
    
    public function ricercaTappa($stayId) {
        if($this->stayId == $stayId)
            return NULL;
        return $this;
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

    public function getActivity() {
        return $this->template;
    }

    public function getAccomodation() {
        
    }

    public function getId() {
        return $this->stayId;
    }

    public function getTransport() {
        return $this->trasporti;
    }

    public function selectActivity($activityIdList, $stayId) {
        
    }

    public function getLocation() {
        return FALSE;
    }

    public function addAccomodation($accomodation) {
        return FALSE;
    }

    public function addActivity($activity) {
        
    }

    public function addTransport($transport) {
        $this->transportComponents[$transport->getId()] = $transport;
        return TRUE;
    }

    public function getEndLocation() {
        return $this->endLocation;
    }

    public function getStartLocation() {
        return $this->startLocation;
    }

    public function removeActivity($idList) {
        
    }
    
    public function getStay($stayId) {
        if($this->stayId != $stayId){
            return FALSE;
        }else{
            return $this;
        }
    }
}

?>
