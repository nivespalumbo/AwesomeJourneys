<?php
include_once 'model/connection.php';
include_once 'model/Itinerary/ItineraryConcreteAggregator.php';
include_once 'model/Itinerary/ItineraryConcreteIterator.php';
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
        $this->aggregator = new ItineraryConcreteAggregator();
    }
    
    public function __sleep() {
        return array("aggregator", "iterator");
    }

    public function __wakeup() {
        
    }

    
    public function search($query = NULL){
        $c = new Connection();
        
        if($query == NULL){
            $query = "SELECT * FROM itinerary WHERE published=1;";
        }
        
        if($c){
            $table = $c->fetch_query($query);
            $c->close();
            if($table){
                $numRows = count($table,COUNT_NORMAL);
                for($i=0; $i<$numRows; $i++){
                   if($table[$i]->state == 1){
                       $itinerary = new CompleteItinerary($table[$i]->creator, $table[$i]->ID, $table[$i]->name, $table[$i]->description);
                       $itinerary->setPhoto($table[$i]->photo);
                       $this->aggregator->add($itinerary);
                   }
                   else{
                       $itinerary = new PartialItinerary($table[$i]->creator, $table[$i]->ID, $table[$i]->name, $table[$i]->description);
                       $itinerary->setPhoto($table[$i]->photo);
                       $this->aggregator->add($itinerary);
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
