<?php

include_once 'model/AJConnection.php';
include_once 'model/Activity/Activity.php';
include_once 'model/Accomodation/Accomodation.php';
include_once 'model/Transport/Transport.php';
include_once 'StayTemplateComposite.php';

/**
 * Description of StaySearchResult
 *
 * @author Nives
 */
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

    
    private function insertActivity(StayTemplateComposite $template, Connection $c){
        if($c){
            $query = "SELECT * "
                   . "FROM (activity_in_stay_template INNER JOIN activity ON activity_in_stay_template.activity_id = activity.ID) INNER JOIN activity_template ON activity.template = activity_template.ID "
                   . "WHERE activity_in_stay_template.stay_template = '".$template->getId()."';";
            //DA CONTROLLARE
            $table = $c->executeQuery($query);
            if($table){
                foreach($table as $row){
                    $activity = new Activity($row->activity_id, $start, $end, $row->template, $row->name, $row->description, $row->location, $a->address, $availableFrom, $availableTo);
                    $template->addComponent($activity->getId(), $activity);
                }  
            }
        }
    }
    
    private function insertAccomodation(StayTemplateComponent $template, Connection $c){
        if($c){
            $query = "SELECT * "
                   . "FROM (accomodation_in_stay_template INNER JOIN accomodation ON accomodation_in_stay_template.accomodation_id = accomodation.ID) INNER JOIN accomodation_template ON accomodation.template = accomodation_template.ID "
                   . "WHERE accomodation_in_stay_template.stay_template = '".$template->getId()."';";
            //DA CONTROLLARE
            $table = $c->executeQuery($query);
            if($table){
                foreach($table as $row){
                    $accomodation = new Accomodation($row->accomodation_id, $row->type, $row->template, $row->name, $row->description, $row->location, $row->address);
                    $template->addComponent($accomodation->getId(), $accomodation);
                }  
            }
        }
    }
    
    private function insertTransport(StayTemplateComposite $template, Connection $c){
        if($c){
            $query = "SELECT * "
                   . "FROM (transport_in_stay_template INNER JOIN transport ON transport_in_stay_template.transport_id = transport.ID) INNER JOIN transport_template ON transport.template = transport_template.ID "
                   . "WHERE transport_in_stay_template.stay_template = '".$template->getId()."';";
            //DA CONTROLLARE
            $table = $c->executeQuery($query);
            if($table){
                foreach($table as $row){
                    $transport = new Transport($row->transport_id, $row->start_location, $row->end_location, $row->vehicle, $row->duration, $row->template);
                    $template->addComponent($transport->getId(), $transport);
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
                foreach($table as $row){
                    if($row->type == STAY_TEMPLATE){
                        $stayTemplate = new StayTemplateComposite($row->ID);
                        $stayTemplate->setStartLocation($row->start_location);
                        $stayTemplate->setEndLocation($row->end_location);
                        $stayTemplate->setStartDate($row->start_date);
                        $stayTemplate->setEndDate($row->end_date);
                        $stayTemplate->setName($row->name);
                        $stayTemplate->setDescription($row->description);
                        
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
