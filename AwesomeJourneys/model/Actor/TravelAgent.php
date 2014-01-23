<?php
include_once 'ConcreteUserComponent.php';

class TravelAgent extends UserComponent{
    private $userComponent;
    
    public function __construct(ConcreteUserComponent $userComponent) {
        $this->userComponent = $userComponent;
    }
    
    public function __sleep() {
        return array('userComponent');
    }
    
    public function __wakeup() {
        
    }
    
    public function getRole() {
        return "Travel Agent";
    }
    public function getName() { return $this->userComponent->getName(); }
    public function getSurname() { return $this->userComponent->getSurname(); }
    public function getAddress() { return $this->userComponent->getAddress(); }
    public function getTelephone() { return $this->userComponent->getTelephone(); }
    public function getMail() { return $this->userComponent->getMail(); }
    public function setAddress($address) { $this->userComponent->setAddress($address); }
    public function setTelephone($telephone) { $this->userComponent->setTelephone($telephone); }

    public function createItinerary() {
        $this->userComponent->createItinerary();
    }

    public function getActivity($id) {
        return $this->userComponent->getActivity($id);
    }

    public function getActivitySearchResult() {
        return $this->userComponent->getActivitySearchResult();
    }

    public function getItinerary($id = NULL) {
        return $this->userComponent->getItinerary($id);
    }

    public function getItinerarySearchResult() {
        return $this->userComponent->getItinerarySearchResult();
    }

    public function getJourney($id) {
        return $this->userComponent->getJourney($id);
    }

    public function getJourneySearchResult() {
        return $this->userComponent->getJourneySearchResult();
    }

    public function getStay($id) {
        return $this->userComponent->getStay($id);
    }

    public function getStaySearchResult() {
        return $this->userComponent->getStaySearchResult();
    }

    public function insertStay($id) {
        $this->userComponent->insertStay($id);
    }

    public function provideBasicInfo($itName, $itDesc) {
        $this->userComponent->provideBasicInfo($itName, $itDesc);
    }

    public function searchActivity($query = NULL) {
        $this->userComponent->searchActivity($query);
    }

    public function searchItinerary($query = NULL) {
        $this->userComponent->searchItinerary($query);
    }

    public function searchJourney($query = NULL) {
        $this->userComponent->searchJourney($query);
    }

    public function searchStay() {
        $this->userComponent->searchStay();
    }

 

}

?>
