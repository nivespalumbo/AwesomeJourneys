<?php
include_once 'model/Journey/JourneySearchResult.php';
include_once 'model/Itinerary/ItinerarySearchResult.php';
include_once 'model/Actor/UserComponent.php';

class SearchController {
    
    public function searchJourneys($query = NULL){
        $searchResult = new JourneySearchResult();
        $searchResult->search($query);
        
        session_start();
        if(isset($_SESSION['utente'])){
            $user = unserialize($_SESSION['utente']);
            $user->setJourneySearchResult($searchResult);
            $_SESSION['utente'] = serialize($user);
        }
        
        return $searchResult;
    }
    
    public function searchItineraries($query = NULL){
        $searchResult = new ItinerarySearchResult();
        $searchResult->search($query);
        
        session_start();
        if(isset($_SESSION['utente'])){
            $user = unserialize($_SESSION['utente']);
            $user->setItinerarySearchResult($searchResult);
            $_SESSION['utente'] = serialize($user);
        }
        
        return $searchResult;
    }
    
    public function searchStays(){
        session_start();
        if(isset($_SESSION['utente'])){
            $user = unserialize($_SESSION['utente']);
            $model = $user->searchStays();
            $_SESSION['utente'] = serialize($user);
            return $model;
        }
        return FALSE;
    }
    
    public function searchActivities(){
        session_start();
        if(isset($_SESSION['utente'])){
            $user = unserialize($_SESSION['utente']);
            $model = $user->searchActivities();
            $_SESSION['utente'] = serialize($user);
            return $model;
        }
        return FALSE;
    }
    
    /**
     * Cerca tutti gli itinerari creati dall'utente loggato
     * @return FALSE se la sessione utente non è settata, altrimenti un
     * ItinerarySearchResult
     */
    public function searchMyItineraries($user){
        $user = unserialize($_SESSION['utente']);
        $searchResult = new ItinerarySearchResult();
        $searchResult->search("SELECT * FROM itinerary WHERE itinerary_creator='".$user->getMail()."'");
        
        $user->setItinerarySearchResult($searchResult);
        $_SESSION['utente'] = serialize($user);
        
        return $searchResult;
    }
    
    /**
     * Cerca tutti i viaggi creati dall'utente loggato
     * @return FALSE se la sessione utente non è settata, altrimenti un
     * JourneySearchResult
     */
    public function searchMyJourneys($user){
        $user = unserialize($_SESSION['utente']);
        $searchResult = new JourneySearchResult();
        $searchResult->search("SELECT * "
                            . "FROM journey INNER JOIN itinerary ON journey.itinerary = itinerary.ID "
                            . "WHERE journey.creator='".$user->getMail()."' "
                            . "ORDER BY start_date;");
        $user->setJourneySearchResult($searchResult);
        $_SESSION['utente'] = serialize($user);

        return $searchResult;  
    }
    
    public function search($startDate, $location){
        if(isset($location) && $location != ""){
            $location = "AND (start_location='$location' OR end_location='$location')";
        }
        if(isset($startDate) && $startDate != ""){
            $startDate = "AND journey.start_date = '$startDate'";
        }
        
        $journeySearchResult = new JourneySearchResult();
        $itinerarySearchResult = new ItinerarySearchResult();
        $risultati = array();
        
        $queryJourney = "SELECT * "
                      . "FROM journey INNER JOIN itinerary ON journey.itinerary = itinerary.ID "
                      . "WHERE journey.published=1 $location $startDate ORDER BY start_date;";
        $journeySearchResult->search($queryJourney);
        $risultati['journeys'] = $journeySearchResult;
        
        $queryItinerary = "SELECT * FROM itinerary WHERE published=1 $location AND state=1;";
        $itinerarySearchResult->search($queryItinerary);
        $risultati['itineraries'] = $itinerarySearchResult;
        
        return $risultati;
    }
    
    public function getJourney($id){
        session_start();
        if(isset($_SESSION['utente'])){
            $user = unserialize($_SESSION['utente']);
            return $user->getJourney($id);
        }
        else {
            $searchResult = new JourneySearchResult();
            $searchResult->search("SELECT * "
                                . "FROM journey INNER JOIN itinerary ON journey.itinerary = itinerary.ID "
                                . "WHERE journey.id_journey=$id");
            return $searchResult->fetchObject();
        }
    }
    
    public function getItinerary($id){
        session_start();
        if(isset($_SESSION['utente'])){
            $user = unserialize($_SESSION['utente']);
            return $user->getItinerary($id);
        }
        else {
            $searchResult = new ItinerarySearchResult();
            $searchResult->search("SELECT * FROM itinerary WHERE ID=$id");
            return $searchResult->fetchObject();
        }
    }
}

?>
