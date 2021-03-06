<?php
include_once 'model/AJConnection.php';
include_once 'model/AJConcreteAggregator.php';
include_once 'model/Itinerary/CompleteItinerary.php';
include_once 'model/Itinerary/PartialItinerary.php';

/**
 * Description of ItinerarySearchResult
 *
 * @author Nives
 */
class ItinerarySearchResult {
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new AJConcreteAggregator();
    }
    
    public function __sleep() {
        return array("aggregator", "iterator");
    }
    public function __wakeup() {  }

    
    public function search($query = NULL){
        $c = new AJConnection();
        
        if($query == NULL){
            $query = "SELECT * FROM itinerary WHERE published=1 AND state=1;";
        }
        
        if($c){
            $table = $c->executeQuery($query);
            $c->close();
            if($table){
                foreach($table as $it){
                    if($it->state == 1){
                        $itinerary = new CompleteItinerary($it->itinerary_creator, $it->name, $it->description, $it->ID);
                    }
                    else{
                        $itinerary = new PartialItinerary($it->itinerary_creator, $it->name, $it->description, $it->ID);
                    }
                    $itinerary->setStartLocation($it->start_location);
                    $itinerary->setEndLocation($it->end_location);
                    $itinerary->setPhoto($it->photo);
                    $itinerary->searchBricks();
                    $this->aggregator->add($itinerary->getId(), $itinerary);
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
