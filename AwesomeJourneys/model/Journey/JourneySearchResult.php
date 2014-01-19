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
                   $itinerary = new CompleteItinerary($table[$i]->creator, $table[$i]->ID, $table[$i]->name, $table[$i]->description);
                   $itinerary->setPhoto($table[$i]->photo);
                   if($table[$i]->published == 1)
                      $this->aggregator->add(new PublishedJourney($itinerary, $table[$i]->start_date, $table[$i]->end_date, $table[$i]->price, $table[$i]->creator, $table[$i]->publish_date));
                   else
                      $this->aggregator->add (new Journey ($itinerary, $table[$i]->start_date, $table[$i]->end_date, $table[$i]->price, $table[$i]->creator));
                }
            }
        }
        
        $this->iterator = $this->aggregator->createIterator(); 
    }
    
//     public function searchItinerary($query){
//        $c = new Connection();
//        
//        if($query == null)
//            $query = "SELECT * FROM itinerary;";
//        
//        if($c){
//            $table = $c->fetch_query($query);
//            $c->close();
//            if($table){
//                $numRows = count($table,COUNT_NORMAL);
//                for($i=0; $i<$numRows; $i++){
//                   if($table[$i]->state == 1){
//                       $itinerary = new CompleteItinerary($table[$i]->creator, $table[$i]->ID, $table[$i]->name, $table[$i]->description);
//                       $itinerary->setPhoto($table[$i]->photo);
//                      $this->aggregator->add($itinerary);
//                   }
//                   else{
//                       $itinerary = new PartialItinerary($table[$i]->creator, $table[$i]->ID, $table[$i]->name, $table[$i]->description);
//                       $itinerary->setPhoto($table[$i]->photo);
//                      $this->aggregator->add($itinerary);
//                   }
//                }
//            }
//        }
//        
//        $this->iterator = $this->aggregator->createIterator(); 
//    }
    
    public function fetchObject() {
        if ($this->iterator->hasNext())
            return $this->iterator->next();
        else
            return NULL;
    }
    
    public function replay(){
        $this->iterator->replay();
    }
}
?>
