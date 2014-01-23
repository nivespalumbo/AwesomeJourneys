<?php
include_once 'model/connection.php';
include_once 'model/Journey/JourneyConcreteAggregator.php';
include_once 'model/Journey/JourneyConcreteIterator.php';
include_once 'model/Journey/Journey.php';
include_once 'model/Journey/PublishedJourney.php';
include_once 'model/Itinerary/CompleteItinerary.php';

class JourneySearchResult {
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new JourneyConcreteAggregator();
    }
    
    public function __sleep() {
        return array("aggregator", "iterator");
    }

    public function __wakeup() {
        
    }

    
    /*
     * DA MODIFICARE, CREARE UN'ALTRA FUNZIONE PRIVATA CHE RICERCA IN DB
     */
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
                    $itinerary = new CompleteItinerary($j->itinerary_creator, $j->name, $j->description, $j->itinerary, $j->photo);
                    if($j->published == 1){
                        $this->aggregator->add(new PublishedJourney($j->id_journey, $itinerary, $j->start_date, $j->end_date, $j->price, $j->creator, $j->publish_date));
                    }
                    else{
                        $this->aggregator->add (new Journey($j->id_journey, $itinerary, $j->start_date, $j->end_date, $j->price, $j->creator));
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
    
    public function replay(){
        $this->iterator->replay();
    }
    
    public function getObject($id){
        return $this->aggregator->getObject($id);
    }
}
?>
