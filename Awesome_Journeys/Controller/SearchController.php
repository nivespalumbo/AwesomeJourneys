<?php
include_once 'model/Journey/JourneySearchResult.php';
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
    
    public function home_sito(){
        $model = new JourneySearchResult();
        $model->searchJourney(null);
        return $model;
    }
    
    public function searchStay(){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        $user->setStaySearchResult();
        return TRUE;
    }
    
    public function apriRicerca(){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        $user->setSearchResultItineraryOrJourney();
        return TRUE;
    }
    
    public function search(){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        /*DA RICAVARE TRAMITE VISTA I PARAMETRI DELLE RICERCH CON METODO POST O
         * GET E SPEDIRLI A $user 
         */
        return TRUE;
    }
}

?>
