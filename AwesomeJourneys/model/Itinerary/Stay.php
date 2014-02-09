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
    

     
    public function update($startDate, $endDate){
        if($this->updateInDb($startDate, $endDate)){
            $this->startDate = $startDate;
            $this->endDate = $endDate;
            return TRUE;
        }
        return FALSE;
    }
    
    public function addActivity(Activity $a){
        if($a->getId() == NULL){
            $a->save();
        }
        if($this->saveActivityInDb($a->getId())){
            $this->selectedActivities[$a->getId()] = $a;
        }
    }
    
    public function updateActivity($id, $date, $persons){
        if(array_key_exists($id, $this->selectedActivities)){
            if($this->updateActivityInDb($id, $date, $persons)){
                $this->selectedActivities[$id]->setDate($date);
                $this->selectedActivities[$id]->setPersons($persons);
                return TRUE;
            }
        }
        return FALSE;
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
    
    public function updateAccomodation($date, $duration){
        if($this->updateAccomodationInDb($date, $duration)){
            $this->selectedAccomodation->setStartDate($date);
            $this->selectedAccomodation->setDuration($duration);
            return TRUE;
        }
        return FALSE;
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
    
    private function updateInDb($startDate, $endDate){
        $c = new AJConnection();
        try{
            $sql = "UPDATE itinerary_brick SET start_date='$startDate', end_date='$endDate' WHERE ID=$this->id;";
            $c->executeNonQuery($sql);
            $c->close();
            return TRUE;
        } catch (Exception $ex) {
            $c->close();
            return FALSE;
        }
    }
    
    private function saveActivityInDb($idActivity){
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
    
    private function updateActivityInDb($id, $date, $persons){
        $c = new AJConnection();
        
        try{
            $sql = "UPDATE activity_in_stay "
                 . "SET date='$date', persons = $persons "
                 . "WHERE id_activity=$id AND id_stay=$this->id;";
            $c->executeNonQuery($sql);
            $c->close();
            return TRUE;
        } catch (Exception $ex) {
            $c->close();
            return FALSE;
        }
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
    
    private function updateAccomodationInDb($date, $duration){
        $c = new AJConnection();
        if($c){
            $query = "UPDATE stay SET accomodation_date='$date', accomodation_duration=$duration WHERE ID=$this->id;";
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
            $query = "UPDATE stay SET accomodation_id=NULL, accomodation_date=NULL, accomodation_duration=NULL WHERE ID=$this->id;";
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
                    if($stay->getSelectedAccomodation() != NULL){
                        $stay->getSelectedAccomodation()->setStartDate($table[0]->accomodation_date);
                        $stay->getSelectedAccomodation()->setDuration($table[0]->accomodation_duration);
                    }
                    $stay->setStartDate($table[0]->start_date);
                    $stay->setEndDate($table[0]->end_date);
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
                    $activity = new Activity($row->id_activity, $row->template, $row->name, $row->address, $row->expected_duration, $row->location, $row->description, $row->available_from, $row->available_to);
                    $activity->setDate($row->date);
                    $activity->setPersons($row->persons);
                    
                    $this->setSelectedActivities($activity);
                }
            }
        } catch (Exception $ex) {
            $c->close();
        }
    }
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

