<?php
include_once 'StayTemplateComposite.php';
include_once 'model/Activity/Activity.php';
include_once 'model/Accomodation/Accomodation.php';
include_once 'model/connection.php';
include_once 'StayConcreteAggregator.php';

class StaySearchResult {
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new StayConcreteAggregator();
    }
    
    public function __sleep() {
        return array('aggregator', 'iterator');
    }
    public function __wakeup() { }

    
    private function insertActivity($template, Connection $c){
        if($c){
            $query = "SELECT * "
                   . "FROM (activity_in_stay_template INNER JOIN activity ON activity_in_stay_template.activity_id = activity.ID) INNER JOIN activity_template ON activity.template = activity_template.ID "
                   . "WHERE activity_in_stay_template.stay_template = '".$template->getId()."';";
            //DA CONTROLLARE
            $table = $c->execute_query($query);
            if($table){
                foreach($table as $a){
                    $activity = new Activity($a->activity_id, $template->getId(), $a->template, $a->name, $a->address, $a->expected_duration, $a->location, $a->description);
                    $template->addComponent($activity);
                }  
            }
        }
    }
    
    private function insertAccomodation($template, Connection $c){
        if($c){
            $query = "SELECT * "
                   . "FROM (accomodation_in_stay_template INNER JOIN accomodation ON accomodation_in_stay_template.accomodation_id = accomodation.ID) INNER JOIN accomodation_template ON accomodation.template = accomodation_template.ID "
                   . "WHERE accomodation_in_stay_template.stay_template = '".$template->getId()."';";
            //DA CONTROLLARE
            $table = $c->execute_query($query);
            if($table){
                foreach($table as $acc){
                    $accomodation = new Accomodation($acc->ID, $template->getId(), $acc->numero_disponibilita, $acc->template, $acc->address, $acc->type, $acc->description, $acc->category, $acc->name, $acc->link, $acc->photo, $acc->location);
                    $template->addComponent($accomodation);
                }  
            }
        }
    }
    
    private function creaStruttura($table){
        $struttura = array();
        if($table){
            foreach($table as $row){
                if(!array_key_exists($row->id_parent, $struttura)){
                    $struttura[$row->id_parent] = array();
                }
                array_push($struttura[$row->id_parent], $row->id_child);
            }
        }
        return $struttura;
    }
    
    /*
     * DA MODIFICARE, CREARE UN'ALTRA FUNZIONE PRIVATA CHE RICERCA IN DB
     */
    public function searchStay($query = NULL){
        $c = new Connection();
        
        if($query == NULL){
            $query = "SELECT * FROM stay_template;";
        }
        $queryStructure = "SELECT * FROM stay_template_structure;";
        
        if($c){
            $table = $c->execute_query($query);
            $struttura = $this->creaStruttura($c->execute_query($queryStructure));
            if($table){
                foreach($table as $st){
                    if($st->type == STAY_TEMPLATE){
                        $stayTemplate = new StayTemplateComposite($st->ID);
                        $stayTemplate->setStartLocation($st->start_location);
                        $stayTemplate->setEndLocation($st->end_location);
                        $stayTemplate->setStartDate($st->start_date);
                        $stayTemplate->setEndDate($st->end_date);
                        $stayTemplate->setName($st->name);
                        $stayTemplate->setDescription($st->description);
                        $this->insertAccomodation($stayTemplate, $c);
                        $this->insertActivity($stayTemplate, $c);
                        $this->aggregator->add($stayTemplate);
                    }
                }  
            }
            $c->close();
        }
        
        $this->iterator = $this->aggregator->getIterator(); 
        while($stayTemplate = $this->fetchObject()){
            if(array_key_exists($stayTemplate->getId(), $struttura)){
                foreach($struttura[$stayTemplate->getId()] as $childTemplateId){
                    $stayTemplate->addComponent($this->getObject($childTemplateId));
                }
            }
        }
        $this->iterator->replay();
    }
    
    public function fetchObject() {
        if ($this->iterator->hasNext())
            return $this->iterator->next();
        else
            return NULL;
    }
    
    public function getObject($id){
        return $this->aggregator->getObject($id);
    }
}
?>
