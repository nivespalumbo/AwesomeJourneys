<?php
include_once 'ItineraryBrick.php';
include_once 'model/AJConnection.php';
include_once 'model/Enumerations/ItineraryBrickType.php';

class Stay implements ItineraryBrick{
    private $id;
    private $startLocation;
    private $endLocation;
    private $startDate;
    private $endDate;
    private $template;
    
    private $selectedActivities; //array contenete tutte le attivita
    private $selectedAccomodation; //accomodation selezionata
 
    //private $selectedGoing; //trasporto che rappresenta l'andata della tappa
    //private $selectedReturn; //trasporto che rappresenta il ritorno dalla tappa

    function __construct($id, $startLocation, $endLocation, StayTemplateComposite $template) {
        $this->id = $id;
        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
        $this->template = $template;
        
        $this->selectedActivities = array();
        $this->selectedAccomodation = NULL;
        $this->startDate = NULL;
        $this->endDate = NULL;
    }
    
    public function __sleep() {
        return array('id', 'startLocation', 'endLocation', 'startDate', 'endDate', 'template', 'selectedActivities', 'selectedAccomodation');
    }
    public function __wakeup() { }
    
    
    public function getId(){ return $this->id; }
    public function getTemplate() { return $this->template; }
    public function getType() { return STAY; }
    public function getStartLocation() { return $this->startLocation; }
    public function getEndLocation() { return $this->endLocation; }
    public function getStartDate() { return $this->startDate; }
    public function getEndDate() { return $this->endDate; }
    public function getSelectedActivities() {
        return $this->selectedActivities;
    }
    public function getSelectedAccomodation() {
        return $this->selectedAccomodation;
    }

     
    public function setId($id){
        $this->id = $id;
    }
    public function setStartDate($startDate){
        $this->startDate = $startDate;
    }
    public function setEndDate($endDate){
        $this->endDate = $endDate;
    }
    
    public function setSelectedActivities(Activity $selectedActivity) {
        if(!array_key_exists($selectedActivity->getId(), $this->selectedActivities)){
            $this->selectedActivities[$selectedActivity->getId()] = $selectedActivity;
        }
    }
    public function setSelectedAccomodation(Accomodation $selectedAccomodation = NULL) {
        $this->selectedAccomodation = $selectedAccomodation;
    }
    

     
    
    public function addActivity(Activity $a){
        if($a->getId() == NULL){
            $a->saveIntoDb();
        }
        if($this->saveActivityInDb($a->getId())){
            $this->selectedActivities[$a->getId()] = $a;
        }
    }
    public function removeActivity($id){
        if(array_key_exists($id, $this->selectedActivities) && $this->removeActivityFromDb($id)){
            unset($this->selectedActivities[$id]);
            return TRUE;
        }
        return false;
    }
    
    
    
    public function addAccomodation(Accomodation $a) {
        if($this->saveAccomodationInDb($a->getId())){
            $this->selectedAccomodation = $a;
        }
    }
    public function removeAccomodation(){
        if($this->removeAccomodationFromDb()){
            $this->selectedAccomodation = NULL;
            return TRUE;
        }
        return FALSE;
    }
    
    
    
    public function addTransport(\Transport $t) {
        return FALSE;
    }
    
    public function removeTransport() {
        return FALSE;
    }
    
    
    
    public function insertInDb(AJConnection $c){
        if($c){
            $sql = "INSERT INTO stay (ID, template_id) "
                 . "VALUES ($this->id, ".$this->template->getId().");";
            $c->executeNonQuery($sql);
            return TRUE;
        }
        return FALSE;
    }
    
    private function saveActivityInDb($idActivity = NULL){
        $c = new AJConnection();
        if($c){
            $query = "INSERT INTO activity_in_stay(id_stay, id_activity) VALUES ($this->id, $idActivity);";
            if($c->executeNonQuery($query)){
                $c->close();
                return TRUE;
            }
            $c->close();
        }
        return FALSE;
    }
    
    private function removeActivityFromDb($idActivity){
        $c = new AJConnection();
        if($c){
            $query = "DELETE FROM activity_in_stay WHERE id_stay=$this->id AND id_activity=$idActivity;";
            if($c->executeNonQuery($query)){
                $c->close();
                return TRUE;
            }
            $c->close();
        }
        return FALSE;
    }
    
    private function saveAccomodationInDb($idAccomodation){
        $c = new AJConnection();
        if($c){
            $query = "UPDATE stay SET accomodation_id=$idAccomodation WHERE ID=$this->id;";
            if($c->executeNonQuery($query)){
                $c->close();
                return TRUE;
            }
            $c->close();
        }
        return FALSE;
    }
    
    private function removeAccomodationFromDb(){
        $c = new AJConnection();
        if($c){
            $query = "UPDATE stay SET accomodation_id=NULL WHERE ID=$this->id;";
            if($c->executeNonQuery($query)){
                $c->close();
                return TRUE;
            }
            $c->close();
        }
        return FALSE;
    }
    
    public static function getStay($idStay){
        $c = new AJConnection();
        if($c){
            $sql = "SELECT * FROM stay INNER JOIN itinerary_brick ON stay.ID = itinerary_brick.ID WHERE stay.ID=$idStay;";
            $table = $c->executeQuery($sql);
            $c->close();
            if($table && count($table, COUNT_NORMAL) == 1){
                $searchTemplate = new StaySearchResult();
                $searchTemplate->searchStay("SELECT * FROM stay_template WHERE ID=".$table[0]->template_id.";");
                if($template = $searchTemplate->fetchObject()){
                    $stay = new Stay($table[0]->ID, $table[0]->start_location, $table[0]->end_location, $template);
                    $stay->setSelectedAccomodation($template->getComponent($table[0]->accomodation_id));
                    $stay->searchSelectedActivities();
                    return $stay;
                }
            }
        }
        return NULL;
    }
    
    public function searchSelectedActivities(){
        $c = new AJConnection();
        try{
            $sql = "SELECT * "
                 . "FROM (activity_in_stay INNER JOIN activity ON activity_in_stay.id_activity = activity.ID) INNER JOIN activity_template ON activity.template = activity_template.ID "
                 . "WHERE activity_in_stay.id_stay=$this->id;";
            $table = $c->executeQuery($sql);
            $c->close();
            if($table){
                foreach($table as $row){
                    $activity = new Activity($row->ID, $row->template, $row->name, $row->address, $row->expected_duration, $row->location, $row->description, $row->available_from, $row->available_to);
                    $activity->setStartDate($row->start_date);
                    $activity->setEndDate($row->end_date);
                    
                    $this->setSelectedActivities($activity);
                }
            }
        } catch (Exception $ex) {
            $c->close();
        }
    }
    
//    public function manageActivityInStay($stayId){
//        if($stayId != $this->stayId){
//            return FALSE;
//        }
//        
//        return $this->attivita;
//    }
//    
//    public function selectGoing($transport) {
//        $this->selectedGoing = $transport;
//    }
//    
//    public function selectReturn($transport){
//        $this->selectedReturn = $transport;
//    }
//    
//    public function visualizza_tappe() {
//        $ris = array();
//        $ris[$this->stayId] = $this;
//        return $ris;
//    }
//
//    public function selectActivity($activityIdList, $stayId) {
//        if($this->stayId != $stayId)
//            return FALSE;
//        $ris = array();
//        foreach($activityIdList as $act){
//            if(isset($this->attivita[$act->getId()])){
//                $ris[$act->getId()] = $act;
//            }    
//        }
//        return $ris;
//    }
//
//    public function getLocation() {
//        return $this->startLocation;
//    }
//
//    public function getStay($stayId) {
//        if($this->stayId == $stayId){
//            return $this;
//        }else if(isset ($this->components[$stayId])){
//            return $this->components[$stayId];
//        }else{
//            foreach($this->components as $children){
//                return $children->getStay($stayId);
//            }
//        }
//        return FALSE;
//    }
//
//    public function getEndLocation() {
//        return $this->endLocation;
//    }
//
//    public function getStartLocation() {
//        return $this->startLocation;
//    }
//
//    public function getComposite() {
//        return FALSE;
//    }
//
//    public function getType() {
//        return STAY;
//    }
//
//    public function newStay() {
//        return FALSE;
//    }
//
//    public function setEndLocation($location) {
//        return FALSE;
//    }
//
//    public function setStartLocation($location) {
//        return FALSE;
//    }
//
//    public function isComposite() {
//        return FALSE;
//    }
//
//    public function getGoing() {
//        return $this->selectedGoing->getSelectedTransport();
//    }
//    
//    public function getReturn() {
//        return $this->selectedReturn->getSelectedTransport();
//    }
//
//    public function addComponent(\StayTemplateComponent $component) {
//        return FALSE;
//    }
//
//    public function getSelectedAccomodation() {
//        return $this->selectedAccomodation;
//    }
//
//    public function getSelectedActivities() {
//        return $this->selectedActivities;
//    }
//
//    public function newItineraryBick() {
//        return FALSE;
//    }
//
//    public function removeComponent($id) {
//        return FALSE;
//    }
//
//    public function getTransports() {
//        return $this->stayTemplate->getTransports();
//    }
//
//    public function getSelectedTransport() {
//        return FALSE;
//    }
//    
//    public function getDescription() {
//        return $this->description;
//    }
//
//    public function getName() {
//        return $this->name;
//    }
//
//    public function setDescription($description) {
//        $this->description = $description;
//    }
//
//    public function setName($name) {
//        $this->name = $name;
//    }
//
//    public function getEndDate() {
//        return $this->endDate;
//    }
//
//    public function getStartDate() {
//        return $this->startDate;
//    }
//
//    public function setEndDate($endDate) {
//        $this->endDate = $endDate;
//    }
//
//    public function setStartDate($startDate) {
//        $this->startDate = $startDate;
//    }
//
//    public function save() {
//        $db = new Connection();
//        $db->begin_transaction();
//        
//        if(!$this->saveByConnection($db)){
//            $db->rollback();
//            $db->close();
//            return FALSE;
//        }
//        
//        $db->commit();
//        $db->close();
//        return TRUE;
//    }
//    
//    private function saveActivitiesInDB(Connection $db){
//        if(count($this->selectedActivities) == 0){
//            return TRUE;
//        }
//        $sql = "";
//        foreach ($this->selectedActivities as $activity){
//            $sql .= "INSERT INTO activity_in_stay(id_stay, id_activity) VALUES (".$this->stayId." ,".$activity->getId().");";
//        }
//        if(!$db->execute_non_query($sql)){
//            return FALSE;
//        }
//        return TRUE;
//    }
//    
//    private function saveDataIntoStayTable(Connection $db){
//        $sql1 = "INSERT INTO stay (ID, template_id";
//        $sql2 = " VALUES(".$this->stayId.", ".$this->stayTemplate->getId();
//        
//        if($this->selectedAccomodation != NULL){
//            $sql1 .= " ,accomodation_id";
//            $sql2 .= " ,".$this->selectedAccomodation->getId();
//        }
//        
//        if($this->selectedGoing != NULL){
//            $sql1 .= " ,id_going_transport";
//            $sql2 .= " ,".$this->selectedGoing->getId();
//            
//        }
//        
//        if($this->selectedReturn != NULL){
//            $sql1 .= " ,id_return_transport";
//            $sql2 .= " ,".$this->selectedReturn->getId();
//        }
//        
//        $sql1 .= ")";
//        $sql2 .= ");";
//        
//        if(!$db->execute_non_query($sql1.$sql2)){
//            return FALSE;
//        }
//        return TRUE;
//    }
//
//    public function saveByConnection(Connection $db) {
//        $sql = "INSERT INTO itinerary_brick (start_location, end_location, type, id_itinerary, start_date, end_date) ".
//                "VALUES ('".$this->startLocation."', '".$this->endLocation."', ".$this->type.", ".$this->itineraryId.
//                        ", ".$this->startDate.", ".$this->endDate.");";
//        if(!$db->execute_non_query($sql)){
//            return FALSE;
//        }
//        $this->stayId = $db->last_inserted_id();
//        
//        if(!$this->saveDataIntoStayTable($db)){
//            return FALSE;
//        }
//        
//        /*if($this->selectedGoing != NULL and $this->selectedGoing->getType() == TRANSFER){
//            if(!$this->selectedGoing->saveByConnection($db)){
//               return FALSE;
//            }
//        }
//        
//        if($this->selectedReturn != NULL and $this->selectedReturn->getType() == TRANSFER){
//           if(!$this->selectedReturn->saveByConnection($db)){
//                return FALSE;
//            }
//        }*/
//        
//        foreach($this->components as $child){
//            if(!$child->saveByConnection($db)){
//                return FALSE;
//            }
//        }
//        
//        return $this->saveActivitiesInDB($db);
//    }
//
//    public function getItineraryId() {
//        return $this->itineraryId;
//    }
//
//    public function setItineraryId($id) {
//        $this->itineraryId = $id;
//    }
//    
//    private function controlContiguous($location, $date){
//        if($this->selectedGoing == NULL){
//            if($location != $this->startLocation){
//                return FALSE;
//            }
//            return TRUE;
//        }
//        if(!$this->selectedGoing->getStartLocation() != $location || ($date != NULL && $this->isEqualDay($this->startDate, $date))){
//            return FALSE;
//        }
//        return TRUE;
//    }
//    
//    private function isEqualDay($datetime1, $datatime2){
//        list($yyyy1, $mm1, $rest1) = split('-', $datetime1);
//        list($dd1, $hour1) = split(' ', $rest1);
//        
//        list($yyyy2, $mm2, $rest2) = split('-', $datatime2);
//        list($dd2, $hour2) = split(' ', $rest2);
//        
//        return $yyyy1 == $yyyy2 and $mm1 == $mm2 and $dd1 == $dd2;
//    }
//
//    public function isContiguous($location, $date = NULL) {
//        if($location == NULL){
//            return $this->selectedGoing != NULL;
//        }
//        if($this->controlContiguous($location, $date)){
//            foreach($this->components as $child){
//                if(!$child->isContiguous($this->startLocation, $this->endDate)){
//                    return FALSE;
//                }
//            }
//            return TRUE;
//        }
//        return FALSE;
//    }

}

