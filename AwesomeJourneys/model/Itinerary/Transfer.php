<?php
include_once 'ItineraryBrick.php';
include_once 'model/Enumerations/ItineraryBrickType.php';
include_once 'model/AJConnection.php';

class Transfer implements ItineraryBrick{
    private $id;
    private $startLocation;
    private $endLocation;
    private $startDate;
    private $endDate;
    private $template;
    
    private $selectedTransport;
    
    function __construct($id, $startLocation, $endLocation, Transport $template) {
        $this->id = $id;
        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
        $this->template = $template;
        
        $this->selectedTransport = $template;
        $this->startDate = NULL;
        $this->endDate = NULL;
    }
    
    public function __sleep(){
        return array('id', 'startLocation', 'endLocation', 'startDate', 'endDate', 'selectedTransport', 'template');
    }
    public function __wakeup() { }

    
    
    public function getId() {
        return $this->id;
    }
    public function getType(){
        return TRANSFER;
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
    public function getTemplate() {
        return $this->template;
    }
    public function getSelectedTransport() {
        return $this->selectedTransport;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

        
    
    public function addAccomodation(\Accomodation $a) {
        return FALSE;
    }

    public function addActivity(\Activity $a) {
        return FALSE;
    }

    public function removeAccomodation() {
        return FALSE;
    }

    public function removeActivity($id) {
        return false;
    }
    
    public function addTransport(\Transport $t) {
        if($this->saveTransportInDb($t->getId())){
            $this->selectedTransport = $t;
        }
    }
    
    public function removeTransport() {
        if($this->removeTransportFromDb()){
            $this->selectedTransport = NULL;
            return TRUE;
        }
        return FALSE;
    }

    
    
    public function insertInDb(AJConnection $c){
        if($c){
            $sql = "INSERT INTO transfer (ID, transport_id) "
                 . "VALUES ($this->id, ".$this->selectedTransport->getId().");";
            $c->executeNonQuery($sql);
            return TRUE;
        }
        return FALSE;
    }
    
    private function saveTransportInDb($idTransport){
        $c = new AJConnection();
        if($c){
            $query = "UPDATE transfer SET transport_id=$idTransport WHERE ID=$this->id;";
            if($c->executeNonQuery($query)){
                $c->close();
                return TRUE;
            }
            $c->close();
        }
        return FALSE;
    }
    
    private function removeTransportFromDb(){
        $c = new AJConnection();
        if($c){
            $query = "UPDATE transfer SET transport_id=NULL WHERE ID=$this->id;";
            if($c->executeNonQuery($query)){
                $c->close();
                return TRUE;
            }
            $c->close();
        }
        return FALSE;
    }
}
