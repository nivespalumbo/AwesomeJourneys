<?php
/*
 * Da ricontrollare gli include.
 */
include_once 'model/connection.php';
include_once 'model/Journey/JourneyConcreteAggregator.php';
include_once 'model/Journey/JourneyConcreteIterator.php';
include_once 'model/Journey/Journey.php';
include_once 'model/Journey/PublishedJourney.php';
include_once 'model/Itinerary/ConcreteStateCompleteItinerary.php';

class StaySearchResult {
    private $c;
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new StayConcreteAggregator();
    }
    
    private function fetch_query($query){
        return $this->c->fetch_query($query);
    }
    
    private function insertActivity($template){
        if($this->c){
            //DA CONTROLLARE
            $table = $$this->fetch_query("SELECT * activity_template WHERE activity.stay=".$template->getTemplateId().";");
            if($table){
                $numRows = count($table,COUNT_NORMAL);
                for($i=0; $i<$numRows; $i++){
                    //DA CONTROLLARE   $id, $stayTemplateId, $expected_duration, $location, $description, $name, $start_date
                    $activity = new Activity($table[$i]->ID, $table[$i]->stay, $table[$i]->expected_duration, $table[$i]->location, $table[$i]->description, $table[$i]->name, $table[$i]->start_date);
                    $this->$template->add($activity);
                }     
            }
        }
    }
    
    private function insertAccomodation($template){
        if($this->c){
            //DA CONTROLLARE
            $table = $this->fetch_query("SELECT * FROM accomodation INNER JOIN accomodation_template ON accomodation.template = accomodation_template.ID WHERE accomodation.stay=".$template->getTemplateId().";");
            if($table){
                $numRows = count($table,COUNT_NORMAL);
                for($i=0; $i<$numRows; $i++){
                    //DA CONTROLLARE
                    $activity = new Activity($table[$i]->ID, $table[$i]->description, $table[$i]->category, $table[$i]->tag, $table[$i]->photo, $table[$i]->creator);
                    $this->$template->add($activity);
                }     
            }
        }
    }
    
    /*
     * DA MODIFICARE, CREARE UN'ALTRA FUNZIONE PRIVATA CHE RICERCA IN DB
     */
    public function search(){
        $$this->c = new Connection();
        
        $query = "SELECT * FROM stay_template;";
        
        if($this->c){
            $table = $this->fetch_query($query);
            if($table){
                $numRows = count($table,COUNT_NORMAL);
                for($i=0; $i<$numRows; $i++){
                    $template = new StayTemplate($table[$i]->ID, $table[$i]->description, $table[$i]->category, $table[$i]->tag, $table[$i]->photo, $table[$i]->creator);
                    $this->insertActivity($template);
                    $this->aggregator->add($template);
                }     
            }
            $this->c->close();
        }
        
        $this->iterator = $this->aggregator->createIterator(); 
    }
    
    public function fetch_object() {
        if ($this->iterator->hasNext())
            return $this->iterator->next();
        else
            return NULL;
    }
}
?>
