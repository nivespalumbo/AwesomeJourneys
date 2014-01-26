<?php

/**
 * Description of ConcreteUserComponent
 *
 * @author Nives
 */
class ConcreteUserComponent extends UserComponent{
    private $sessionId;
    private $name;
    private $surname;
    private $address;
    private $telephone;
    private $mail;
    
    private $staySearchResult = NULL;
    private $activitySearchResult = NULL;
    private $itinerarySearchResult = NULL;
    private $journeySearchResult = NULL;
    
    private $itineraryContext = NULL;
    
    function __construct($sessionId, $name, $surname, $address, $telephone, $mail) {
        $this->sessionId = $sessionId;
        $this->name = $name;
        $this->surname = $surname;
        $this->address = $address;
        $this->telephone = $telephone;
        $this->mail = $mail;
    }
    
    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getStaySearchResult() {
        return $this->staySearchResult;
    }

    public function getActivitySearchResult() {
        return $this->activitySearchResult;
    }
    
    public function getItinerarySearchResult(){
        return $this->itinerarySearchResult;
    }
    
    public function getJourneySearchResult(){
        return $this->journeySearchResult;
    }

    public function __sleep() {
        return array('sessionId', 'name', 'surname', 'address', 'telephone', 'mail', 'staySearchResult', 'activitySearchResult', 'itinerarySearchResult', 'journeySearchResult', 'itineraryContext');
    }

    public function __wakeup() {
        
    }
}
