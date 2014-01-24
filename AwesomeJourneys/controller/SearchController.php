<?php
include_once 'model/Journey/JourneySearchResult.php';
include_once 'model/Itinerary/ItinerarySearchResult.php';
include_once 'model/Actor/UserComponent.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchController
 *
 * @author anto
 */
class SearchController {
    
    // Abbiamo deciso che in homepage ci saranno i viaggi pubblicati
    public function home(){
        $model = new JourneySearchResult();
        $model->search(null);
        return $model;
    }
    
    // Da riguardare
    public function searchStay(){
        session_start();
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        $user->searchStay();
        $_SESSION['utente'] = serialize($user);
        return $user->getStaySearchResult();
    }
    
    /**
     * Cerca tutti gli itinerari creati dall'utente loggato
     * @return FALSE se la sessione utente non è settata, altrimenti un
     * ItinerarySearchResult
     */
    public function searchMyItineraries(){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        $user->searchItinerary("SELECT * FROM itinerary WHERE itinerary_creator='".$user->getMail()."'");
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerarySearchResult();
    }
    
    /**
     * Cerca tutti i viaggi creati dall'utente loggato
     * @return FALSE se la sessione utente non è settata, altrimenti un
     * JourneySearchResult
     */
    public function searchMyJourneys(){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        $user->searchJourney("SELECT * FROM journey INNER JOIN itinerary ON journey.itinerary = itinerary.ID WHERE journey.creator='".$user->getMail()."' ORDER BY start_date;");
        $_SESSION['utente'] = serialize($user);
        return $user->getJourneySearchResult();        
    }
    
    public function search(){
        $location = ""; $startDate = "";
        if(isset($_GET['location']) && $_GET['location'] != ""){
            $location = "AND location='".$_GET['location']."'";
        }
        if(isset($_GET['startDate']) && $_GET['startDate'] != ""){
            $startDate = "AND journey.start_date = '".$_GET['startDate']."'";
        }
        
        $journeySearchResult = new JourneySearchResult();
        $itinerarySearchResult = new ItinerarySearchResult();
        $risultati = array();
        
        $queryJourney = "SELECT * "
                      . "FROM journey INNER JOIN itinerary ON journey.itinerary = itinerary.ID "
                      . "WHERE journey.published=1 $location $startDate ORDER BY start_date;";
        $journeySearchResult->search($queryJourney);
        $risultati['journeys'] = $journeySearchResult;
        
        $queryItinerary = "SELECT * FROM itinerary WHERE published=1 AND state=2;";
        $itinerarySearchResult->search($queryItinerary);
        $risultati['itineraries'] = $itinerarySearchResult;
        
        return $risultati;
    }
}

?>
