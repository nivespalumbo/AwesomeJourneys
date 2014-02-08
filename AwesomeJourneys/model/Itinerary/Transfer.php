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
    
    public function updateActivity($idActivity, $date, $persons) {
        return FALSE;
    }
    
    public function updateAccomodation($date, $duration) {
        return FALSE;
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

    public static function getTransfer($id){
        $c = new AJConnection();
        if($c){
            $sql = "SELECT * FROM transfer INNER JOIN itinerary_brick ON transfer.ID = itinerary_brick.ID WHERE transfer.ID=$id;";
            $table = $c->executeQuery($sql);
            if($table && count($table, COUNT_NORMAL) == 1){
                $template = $c->executeQuery("SELECT transport.ID, transport.start_date, transport.duration, transport.from_location, transport.to_location, transport.template, transport_template.name, transport_template.description, transport_template.vehicle "
                                           . "FROM transport INNER JOIN transport_template ON transport.template = transport_template.ID "
                                           . "WHERE transport.ID=".$table[0]->transport_id.";");
                if(count($template, COUNT_NORMAL) == 1){
                    $transfer = new Transfer($id, $template[0]->from_location, $template[0]->to_location, new Transport($template[0]->ID, $template[0]->start_date, $template[0]->duration, $template[0]->from_location, $template[0]->to_location, $template[0]->template, $template[0]->name, $template[0]->description, $template[0]->vehicle));
                    return $transfer;
                }
            }
        }
        return NULL;
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
