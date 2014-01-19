<?php
include_once 'model/Journey/JourneySearchResult.php';
include_once 'model/Itinerary/ItinerarySearchResult.php';
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
        $model->searchJourney(null);
        return $model;
    }
    
    // Da riguardare
    public function searchStay(){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        $user->setStaySearchResult();
        return TRUE;
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
        $user->setSearchResultItinerary();
        return $user->searchItineraries("SELECT * FROM itinerary WHERE creator='".$user->getMail()."'");
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
        $user->setSearchResultJourney();
        return $user->searchJourneys("SELECT * FROM journey INNER JOIN itinerary ON journey.itinerary = itinerary.ID WHERE journey.creator='".$user->getMail()."' ORDER BY start_date;");
    }
    
//    public function apriRicerca(){
//        if(!isset($_SESSION['utente']))
//            return FALSE;
//        $user = unserialize($_SESSION['utente']);
//        $user->setSearchResultItineraryOrJourney();
//        return $user;
//    }
    
    // #TODO
    public function search(){
//        if(!isset($_SESSION['utente']))
//            return FALSE;
//        $user = unserialize($_SESSION['utente']);
//        /*DA RICAVARE TRAMITE VISTA I PARAMETRI DELLE RICERCH CON METODO POST O
//         * GET E SPEDIRLI A $user 
//         */
//        return TRUE;
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
        $journeySearchResult->searchJourney($queryJourney);
        $risultati['journeys'] = $journeySearchResult;
        
        $queryItinerary = "SELECT * FROM itinerary WHERE published=1;";
        $itinerarySearchResult->searchItinerary($queryItinerary);
        $risultati['itineraries'] = $itinerarySearchResult;
        
        return $risultati;
    }
}

?>
