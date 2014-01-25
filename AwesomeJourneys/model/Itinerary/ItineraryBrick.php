<?php
include_once 'model/StayTemplate/StayTemplateComponent.php';

interface ItineraryBrick {
    public function getId();
    public function getTemplate();
    public function getItineraryId();
    public function getStartLocation();
    public function getEndLocation();
    public function getStartDate();
    public function getEndDate();
    
    /**
     * Restituisce l'elenco delle attività disponibili
     */
    public function getActivities();
    public function getActivity($idActivity);
    /**
     * Restituisce l'elenco delle attività selezionate
     */
    public function getSelectedActivities();
    /**
     * Inserisce l'attività tra le attività selezionate
     */
    public function setSelectedActivities(Activity $activity);
    /**
     * Salva in database l'attività e la inserisce tra le attività selezionate
     */
    public function addActivity($idActivity);
    /**
     * Rimuove dal database l'attività e la rimuove anche dalle attività selezionate
     */
    public function removeActivity($idActivity);
    
    /**
     * Restituisce l'elenco delle possibili accomodations
     */
    public function getAccomodations();
    /**
     * Restituisce l'accomodation selezionata
     */
    public function getSelectedAccomodation();
    /**
     * Setta la accomodation
     */
    public function setSelectedAccomodation($idAccomodation);
    /**
     * Salva in database l'accomodation e la setta
     */
    public function addAccomodation($idAccomodation);
    /**
     * Rimuove dal database l'accomodation e la rende nulla
     */
    public function removeAccomodation();
    
    
    
//    public function selectGoing($transport);
//    public function selectReturn($transport);
//    public function setItineraryId($id);
    
//    public function save();
//    public function saveByConnection($db);
    
//    public function isContiguous($location, $date = NULL);

    
//    public function getReturn();
//    public function getGoing();
//    public function getSelectedTransport();
    
//    public function getStay($stayId);
}

