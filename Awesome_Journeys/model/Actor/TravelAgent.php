<?php

class TravelAgent extends UserComponent{
    private $userComponent;
    
    public function __construct($userComponent) {
        $this->userComponent = $userComponent;
    }
    
    public function getRole() {
        return "Travel Agent";
    }
    
    public function getName() { return $this->userComponent->getName(); }
    public function getSurname() { return $this->userComponent->getSurname(); }
    public function getAddress() { return $this->userComponent->getAddress(); }
    public function getTelephone() { return $this->userComponent->getTelephone(); }
    public function getMail() { return $this->userComponent->getMail(); }
    
    public function __sleep() {
        return array('userComponent');
    }
    
    public function __wakeup() {
        
    }

    public function getStaySearchResult() {
        return $this->userComponent->getStaySearchResult();
    }

    public function setStaySearchResult() {
        $this->userComponent->setStaySearchResult();
    }
}

?>
