<?php
include_once 'StayTemplateComposite.php';
include_once 'model/Activity/Activity.php';
include_once 'model/Accomodation/Accomodation.php';
include_once 'model/connection.php';
include_once 'StayConcreteAggregator.php';

class StaySearchResult {
    private $c;
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new StayConcreteAggregator();
    }
    
    private function insertActivity($template){
        if($this->c){
            $query = "SELECT * "
                   . "FROM (activity_in_stay_template INNER JOIN activity ON activity_in_stay_template.activity_id = activity.ID) INNER JOIN activity_template ON activity.template = activity_template.ID "
                   . "WHERE activity_in_stay_template.stay_template = '".$template->getId()."';";
            //DA CONTROLLARE
            $table = $this->c->fetch_query($query);
            if($table){
                foreach($table as $a){
                    $activity = new Activity($a->activity_id, $a->start_date, $template->getId(), $a->end_date, $a->template, $a->name, $a->address, $a->expected_duration, $a->location, $a->description);
                    $template->addComponent($activity);
                }  
            }
        }
    }
    
    private function insertAccomodation($template){
        if($this->c){
            $query = "SELECT * "
                   . "FROM (accomodation_in_stay_template INNER JOIN accomodation ON accomodation_in_stay_template.accomodation_id = accomodation.ID) INNER JOIN accomodation_template ON accomodation.template = accomodation_template.ID "
                   . "WHERE accomodation_in_stay_template.stay_template = '".$template->getId()."';";
            //DA CONTROLLARE
            $table = $this->c->fetch_query($query);
            if($table){
                foreach($table as $acc){
                    $accomodation = new Accomodation($acc->ID, $template->getId(), $acc->numero_disponibilita, $acc->start_date, ($acc->end_date - $acc->start_date), $acc->template, $acc->address, $acc->type, $acc->description, $acc->category, $acc->name, $acc->link, $acc->photo, $acc->location);
                    $template->addComponent($accomodation);
                }  
            }
        }
    }
    
    /*
     * DA MODIFICARE, CREARE UN'ALTRA FUNZIONE PRIVATA CHE RICERCA IN DB
     */
    public function search(){
        $this->c = new Connection();
        
        $query = "SELECT * FROM stay_template;";
        
        if($this->c){
            $table = $this->c->fetch_query($query);
            if($table){
                echo 'tabella piena';
                foreach($table as $st){
                    $stayTemplate = new StayTemplateComposite($st->ID);
                    $stayTemplate->setStartLocation($st->start_location);
                    $stayTemplate->setEndLocation($st->end_location);
                    $stayTemplate->setStartDate($st->start_date);
                    $stayTemplate->setEndDate($st->end_date);
                    $stayTemplate->setName($st->name);
                    $stayTemplate->setDescription($st->description);
                    $this->insertAccomodation($stayTemplate);
                    $this->insertActivity($stayTemplate);
                    $this->aggregator->add($stayTemplate);
                }  
            }
            $this->c->close();
        }
        
        $this->iterator = $this->aggregator->getIterator(); 
    }
    
    public function fetchObject() {
        if ($this->iterator->hasNext())
            return $this->iterator->next();
        else
            return NULL;
    }
}
?>
