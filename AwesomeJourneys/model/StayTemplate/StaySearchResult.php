<?php
include_once 'StayTemplateComposite.php';
include_once 'model/Activity/Activity.php';
include_once 'model/Accomodation/Accomodation.php';
include_once 'model/Transport/Transport.php';
include_once 'model/AJConnection.php';
include_once 'model/AJConcreteAggregator.php';

class StaySearchResult {
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new AJConcreteAggregator();
    }
    
    public function __sleep() {
        return array('aggregator', 'iterator');
    }
    public function __wakeup() { }

    
    private function insertActivity($template, AJConnection $c){
        if($c){
            $query = "SELECT * "
                   . "FROM (activity_in_stay_template INNER JOIN activity ON activity_in_stay_template.activity_id = activity.ID) INNER JOIN activity_template ON activity.template = activity_template.ID "
                   . "WHERE activity_in_stay_template.stay_template = ".$template->getId().";";
            //DA CONTROLLARE
            $table = $c->executeQuery($query);
            if($table){
                foreach($table as $a){
                    $activity = new Activity($a->activity_id, $a->template, $a->name, $a->address, $a->expected_duration, $a->location, $a->description, $a->available_from, $a->available_to);
                    $template->addComponent($activity);
                }  
            }
        }
    }
    
    private function insertAccomodation($template, AJConnection $c){
        if($c){
            $query = "SELECT * "
                   . "FROM (accomodation_in_stay_template INNER JOIN accomodation ON accomodation_in_stay_template.accomodation_id = accomodation.ID) INNER JOIN accomodation_template ON accomodation.template = accomodation_template.ID "
                   . "WHERE accomodation_in_stay_template.stay_template = ".$template->getId().";";
            //DA CONTROLLARE
            $table = $c->executeQuery($query);
            if($table){
                foreach($table as $acc){
                    $accomodation = new Accomodation($acc->accomodation_id, $acc->numero_disponibilita, $acc->template, $acc->address, $acc->type, $acc->description, $acc->category, $acc->name, $acc->link, $acc->photo, $acc->location); 
                    $template->addComponent($accomodation);
                }  
            }
        }
    }
    
    private function insertTransport($template, AJConnection $c){
        if($c){
            $query = "SELECT * "
                   . "FROM (transport_in_stay_template INNER JOIN transport ON transport_in_stay_template.transport_id = transport.ID) INNER JOIN transport_template ON transport.template = transport_template.ID "
                   . "WHERE transport_in_stay_template.stay_template = ".$template->getId().";";
            //DA CONTROLLARE
            $table = $c->executeQuery($query);
            if($table){
                foreach($table as $row){
                    $transport = new Transport($row->transport_id, $row->startDate, $row->duration, $row->from_location, $row->to_location, $row->template, $row->name, $row->description, $row->vehicle);
                    $template->addComponent($transport);
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
        $c = new AJConnection();
        
        if($query == NULL){
            $query = "SELECT * FROM stay_template;";
        }
        $queryStructure = "SELECT * FROM stay_template_structure;";
        
        if($c){
            $table = $c->executeQuery($query);
            $struttura = $this->creaStruttura($c->executeQuery($queryStructure));
            if($table){
                foreach($table as $st){
                    if($st->type == STAY_TEMPLATE){
                        $stayTemplate = new StayTemplateComposite($st->ID);
                        $stayTemplate->setStartLocation($st->start_location);
                        $stayTemplate->setEndLocation($st->end_location);
                        $stayTemplate->setName($st->name);
                        $stayTemplate->setDescription($st->description);
                        $this->insertAccomodation($stayTemplate, $c);
                        $this->insertActivity($stayTemplate, $c);
                        $this->insertTransport($stayTemplate, $c);
                        $this->aggregator->add($stayTemplate->getId(), $stayTemplate);
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
    }
    
    public function searchTransport($from){
        $c = new AJConnection();
        if($c){
            $query = "SELECT * "
                   . "FROM transport INNER JOIN transport_template ON transport.template = transport_template.ID "
                   . "WHERE from_location='$from';";
            $table = $c->executeQuery($query);
            if($table){
                foreach($table as $row){
                    $transport = new Transport($row->ID, $row->start_date, $row->duration, $row->from_location, $row->to_location, $row->template, $row->name, $row->description, $row->vehicle);
                    $this->aggregator->add($transport->getId(), $transport);
                }  
            }
        }
        $this->iterator = $this->aggregator->getIterator();
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
