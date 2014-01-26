<?php
include_once 'model/connection.php';
include_once 'model/AJConcreteAggregator.php';
include_once 'model/Journey/Journey.php';
include_once 'model/Journey/PublishedJourney.php';
include_once 'model/Itinerary/CompleteItinerary.php';

class JourneySearchResult {
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new AJConcreteAggregator();
    }
    
    public function __sleep() {
        return array("aggregator", "iterator");
    }
    public function __wakeup() {
        
    }

    
    public function search($query = NULL){
        $c = new Connection();
        
        if($query == NULL){
            $query = "SELECT * "
                    . "FROM journey INNER JOIN itinerary ON journey.itinerary = itinerary.ID "
                    . "WHERE journey.published=1 "
                    . "ORDER BY start_date;";
        }
        
        if($c){
            $table = $c->execute_query($query);
            $c->close();
            if($table){
                foreach($table as $j){
                    $itinerary = new CompleteItinerary($j->itinerary_creator, $j->name, $j->description, $j->start_location, $j->itinerary);
                    $itinerary->setEndLocation($j->end_location);
                    $itinerary->setPhoto($j->photo);
                    if($j->published == 1){
                        $this->aggregator->add($j->id_journey, new PublishedJourney($j->id_journey, $itinerary, $j->start_date, $j->end_date, $j->creator, $j->publish_date));
                    }
                    else{
                        $this->aggregator->add ($j->id_journey, new Journey($j->id_journey, $itinerary, $j->start_date, $j->end_date, $j->creator));
                    }
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
