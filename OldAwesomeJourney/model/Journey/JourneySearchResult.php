<?php
include_once 'model/connection.php';
include_once 'model/Journey/JourneyConcreteAggregator.php';
include_once 'model/Journey/JourneyConcreteIterator.php';
include_once 'model/Journey/Journey.php';
include_once 'model/Journey/PublishedJourney.php';
include_once 'model/Itinerary/ConcreteStateCompleteItinerary.php';

class JourneySearchResult {
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new JourneyConcreteAggregator();
    }
    
    /*
     * DA MODIFICARE, CREARE UN'ALTRA FUNZIONE PRIVATA CHE RICERCA IN DB
     */
    public function searchJourney($query){
        $c = new Connection();
        
        if($query == null)
            $query = "SELECT * FROM journey INNER JOIN itinerary ON journey.itinerary = itinerary.ID WHERE published=1 ORDER BY start_date;";
        
        if($c){
            $table = $c->fetch_query($query);
            $c->close();
            if($table){
                $numRows = count($table,COUNT_NORMAL);
                for($i=0; $i<$numRows; $i++){
                   if($table[$i]->published == 1)
                      $this->aggregator->add(new PublishedJourney(new ConcreteStateCompleteItinerary($table[$i]->ID, $table[$i]->name, $table[$i]->description, $table[$i]->category, $table[$i]->tag, $table[$i]->photo, $table[$i]->creator), $table[$i]->start_date, $table[$i]->end_date, $table[$i]->price, $table[$i]->creator, $table[$i]->publish_date));
                   else
                      $this->aggregator->add (new Journey (new ConcreteStateCompleteItinerary($table[$i]->ID, $table[$i]->name, $table[$i]->description, $table[$i]->category, $table[$i]->tag, $table[$i]->photo, $table[$i]->creator), $table[$i]->start_date, $table[$i]->end_date, $table[$i]->price, $table[$i]->creator));
                }
            }
        }
        
        $this->iterator = $this->aggregator->createIterator(); 
    }
    
     public function searchItinerary($query){
        $c = new Connection();
        
        if($query == null)
            $query = "SELECT * FROM itinerary;";
        
        if($c){
            $table = $c->fetch_query($query);
            $c->close();
            if($table){
                $numRows = count($table,COUNT_NORMAL);
                for($i=0; $i<$numRows; $i++){
                   if($table[$i]->state == 2)
                      $this->aggregator->add(new ConcreteStateCompleteItinerary($table[$i]->ID, $table[$i]->name, $table[$i]->description, $table[$i]->category, $table[$i]->tag, $table[$i]->photo, $table[$i]->creator));
                   else
                      $this->aggregator->add(new ConcreteStatePartialItinerary($table[$i]->ID, $table[$i]->name, $table[$i]->description, $table[$i]->category, $table[$i]->tag, $table[$i]->photo, $table[$i]->creator));
                }
            }
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
