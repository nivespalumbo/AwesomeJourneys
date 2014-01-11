<?php
include_once 'ItineraryBrick.php';
include_once 'connection.php';

class Stay implements ItineraryBrick{
    private $stayId;
    private $itineraryId;
    private $name;
    private $description;
    private $startLocation;
    private $endLocation;
    private $startDate;
    private $endDate;
    private $selectedActivities;//array contenete tutte le attivita
    private $selectedAccomodation;//accomodation selezionata
    private $selectedGoing;//trasporto che rappresenta l'andata della tappa
    private $selectedReturn;//trasporto che rappresenta il ritorno dalla tappa
    private $stayChildren;
    private $stayTemplate;
    private $type;

    public function __construct($stayId, StayTemplateComposite $stayTemplate) {
        $this->stayId = $stayId;
        $this->selectedActivities = array();
        $this->stayChildren = array();
        $this->selectedAccomodation = NULL;
        $this->selectedReturn = NULL;
        
        $this->type = STAY;
        
        $this->stayTemplate = $stayTemplate;
        
        $this->startLocation = $stayTemplate->getStartLocation();
        $this->endLocation = $stayTemplate->getEndLocation();
    }
    
    public function setLocation($location){
        return FALSE;
    }
    
    public function configureStayParameter($optId, $valId){
        //$this->options[$optId] = $valId;
    }
    
    public function getActivities(){
        return $this->stayTemplate->getActivities();
    }
    
    public function manageActivityInStay($stayId){
        if($stayId != $this->stayId){
            return FALSE;
        }
        
        return $this->attivita;
    }
    
    public function selectGoing($transport) {
        $this->selectedGoing = $transport;
    }
    
    public function selectReturn($transport){
        $this->selectedReturn = $transport;
    }
    
    public function selectActivities($activity) {
        $this->attivita[$activity->getId()] = $activity;
    }
    
    public function selectAccomodation($accomodation) {
        $this->accomodationComponents[$accomodation->getId()] = $accomodation;
        return TRUE;
    }
    
    public function removeSelectedActivity($idList){
        foreach($idList as $id){
            if(isset($this->attivita[$id])){
                unset($this->attivita[$id]);
            }
        }
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
        return $this->stayTemplate->getAccomodation();
    }

    public function getLocation() {
        return $this->startLocation;
    }

    public function getStay($stayId) {
        if($this->stayId == $stayId){
            return $this;
        }else if(isset ($this->stayChildren[$stayId])){
            return $this->stayChildren[$stayId];
        }else{
            foreach($this->stayChildren as $children){
                return $children->getStay($stayId);
            }
        }
        return FALSE;
    }

    public function getEndLocation() {
        return $this->endLocation;
    }

    public function getStartLocation() {
        return $this->startLocation;
    }

    public function getComposite() {
        return FALSE;
    }

    public function getType() {
        $this->type;
    }

    public function newStay() {
        return FALSE;
    }

    public function setEndLocation($location) {
        return FALSE;
    }

    public function setStartLocation($location) {
        return FALSE;
    }

    public function isComposite() {
        return FALSE;
    }

    public function getGoing() {
        return $this->selectedGoing->getSelectedTransport();
    }
    
    public function getReturn() {
        return $this->selectedReturn->getSelectedTransport();
    }

    public function addComponent(\StayTemplateComponent $component) {
        return FALSE;
    }

    public function getSelectedAccomodation() {
        return $this->selectedAccomodation;
    }

    public function getSelectedActivities() {
        return $this->selectedActivities;
    }

    public function newItineraryBick() {
        return FALSE;
    }

    public function removeComponent($id) {
        return FALSE;
    }

    public function getTransports() {
        return $this->stayTemplate->getTransports();
    }

    public function getSelectedTransport() {
        return FALSE;
    }
    
    public function getDescription() {
        return $this->description;
    }

    public function getName() {
        return $this->name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function save() {
        $db = new Connection();
        $db->beginTrasaction();
        
        if(!$this->saveByConnection($db)){
            $db->rollBack();
            $db->close();
            return FALSE;
        }
        
        $db->commit();
        $db->close();
        return TRUE;
    }
    
    private function saveActivitiesInDB(Connection $db){
        if(count($this->selectedActivities) == 0){
            return TRUE;
        }
        $sql = "";
        foreach ($this->selectedActivities as $activity){
            $sql .= "INSERT INTO activity_in_stay(id_stay, id_activity) VALUES (".$this->stayId." ,".$activity->getId().");";
        }
        if(!$db->extecute_non_query($sql)){
            return FALSE;
        }
        return TRUE;
    }
    
    private function saveDataIntoStayTable(Connection $db){
        $sql1 = "INSERT INTO stay (ID, template_id";
        $sql2 = " VALUES(".$this->stayId.", ".$this->stayTemplate->getId();
        
        if($this->selectedAccomodation != NULL){
            $sql1 .= " ,accomodation_id";
            $sql2 .= " ,".$this->selectedAccomodation->getId();
        }
        
        if($this->selectedGoing != NULL){
            $sql1 .= " ,id_going_transport";
            $sql2 .= " ,".$this->selectedGoing->getId();
            
        }
        
        if($this->selectedReturn != NULL){
            $sql1 .= " ,id_return_transport";
            $sql2 .= " ,".$this->selectedReturn->getId();
        }
        
        $sql1 .= ")";
        $sql2 .= ");";
        
        if(!$db->extecute_non_query($sql1.$sql2)){
            return FALSE;
        }
        return TRUE;
    }

    public function saveByConnection(Connection $db) {
        $sql = "INSERT INTO itinerary_brick (start_location, end_location, type, id_itinerary, start_date, end_date) ".
                "VALUES ('".$this->startLocation."', '".$this->endLocation."', ".$this->type.", ".$this->itineraryId.
                        ", ".$this->startDate.", ".$this->endDate.");";
        if(!$db->extecute_non_query($sql)){
            return FALSE;
        }
        $this->stayId = $db->last_id_insert();
        
        if(!$this->saveDataIntoStayTable($db)){
            return FALSE;
        }
        
        /*if($this->selectedGoing != NULL and $this->selectedGoing->getType() == TRANSFER){
            if(!$this->selectedGoing->saveByConnection($db)){
               return FALSE;
            }
        }
        
        if($this->selectedReturn != NULL and $this->selectedReturn->getType() == TRANSFER){
           if(!$this->selectedReturn->saveByConnection($db)){
                return FALSE;
            }
        }*/
        
        foreach($this->stayChildren as $child){
            if(!$child->saveByConnection($db)){
                return FALSE;
            }
        }
        
        return $this->saveActivitiesInDB($db);
    }

    public function getItineraryId() {
        return $this->itineraryId;
    }

    public function setItineraryId($id) {
        $this->itineraryId = $id;
    }
    
    private function controlContiguous($location, $date){
        if($this->selectedGoing == NULL){
            if($location != $this->startLocation){
                return FALSE;
            }
            return TRUE;
        }
        if(!$this->selectedGoing->getStartLocation() != $location || ($date != NULL && $this->isEqualDay($this->startDate, $date))){
            return FALSE;
        }
        return TRUE;
    }
    
    private function isEqualDay($datetime1, $datatime2){
        list($yyyy1, $mm1, $rest1) = split('-', $datetime1);
        list($dd1, $hour1) = split(' ', $rest1);
        
        list($yyyy2, $mm2, $rest2) = split('-', $datatime2);
        list($dd2, $hour2) = split(' ', $rest2);
        
        return $yyyy1 == $yyyy2 and $mm1 == $mm2 and $dd1 == $dd2;
    }

    public function isContiguous($location, $date = NULL) {
        if($location == NULL){
            return $this->selectedGoing != NULL;
        }
        if($this->controlContiguous($location, $date)){
            foreach($this->stayChildren as $child){
                if(!$child->isContiguous($this->startLocation, $this->endDate)){
                    return FALSE;
                }
            }
            return TRUE;
        }
        return FALSE;
    }

}

