<?php

include_once 'model/AJConnection.php';
include_once 'model/AJConcreteAggregator.php';
include_once 'Journey.php';
include_once 'PublishedJourney.php';
include_once 'model/Itinerary/CompleteItinerary.php';

/**
 * Description of JourneySearchResult
 *
 * @author Nives
 */
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
            $table = $c->executeQuery($query);
            $c->close();
            if($table){
                foreach($table as $row){
                    $itinerary = new CompleteItinerary($row->itinerary, $row->name, $row->description);
                    $itinerary->setPhoto($row->photo);
                    
                    if($row->published == 1){
                        $this->aggregator->add($row->id_journey, new PublishedJourney($row->id_journey, $row->start_date, $row->end_date, $itinerary, $row->creator));
                    }
                    else{
                        $this->aggregator->add ($j->id_journey, new Journey($row->id_journey, $row->start_date, $row->end_date, $itinerary, $row->creator));
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
