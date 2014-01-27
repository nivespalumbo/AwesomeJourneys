<?php

/**
 * Description of Stay
 *
 * @author Nives
 */
class Stay implements ItineraryBrick{
    private $id;
    private $startLocation;
    private $endLocation;
    private $template;
    
    private $selectedActivities;
    private $selectedAccomodation;
    
    function __construct($id, $startLocation, $endLocation, StayTemplateComposite $template) {
        $this->id = $id;
        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
        $this->template = $template;
        
        $this->selectedActivities = array();
        $this->selectedAccomodation = NULL;
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
        return STAY;
    }

    public function getTemplate() {
        return $this->template;
    }

    public function setStartLocation($startLocation) {
        $this->startLocation = $startLocation;
    }

    public function setEndLocation($endLocation) {
        $this->endLocation = $endLocation;
    }
    
    public function addActivity(Activity $a){
        if($a->getId() == NULL){
            $a->saveIntoDb();
        }
        if($this->saveActivityInDb($a->getId())){
            $this->selectedActivities[$a->getId()] = $a;
        }
    }
    
    public function addAccomodation(Accomodation $a){
        if($this->saveAccomodationInDb($a->getId())){
            $this->selectedAccomodation = $a;
        }
    }
    
    public function removeActivity($id){
        if(array_key_exists($id, $this->selectedActivities) && $this->removeActivityFromDb($id)){
            unset($this->selectedActivities[$id]);
            return TRUE;
        }
        return false;
    }
    
    public function removeAccomodation(){
        if($this->removeAccomodationFromDb()){
            $this->selectedAccomodation = NULL;
            return TRUE;
        }
        return FALSE;
    }
    
    public function addTransport(Transport $t){
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

    public function __sleep() {
        return array('id', 'startLocation', 'endLocation', 'template', 'selectedActivities', 'selectedAccomodation');
    }

    public function __wakeup() {
        
    }

}
