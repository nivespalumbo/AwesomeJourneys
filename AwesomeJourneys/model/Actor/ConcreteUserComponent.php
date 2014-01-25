<?php
include_once 'model/Itinerary/ItineraryContext.php';
include_once 'model/Itinerary/ItineraryState.php';
include_once 'model/Journey/JourneySearchResult.php';
include_once 'model/StayTemplate/StaySearchResult.php';
include_once 'model/Activity/ActivitySearchResult.php';

class ConcreteUserComponent extends UserComponent{
    private $session_id;
    private $mail;
    private $name;
    private $surname;
    private $address;
    private $telephone;
    private $itineraryContext;
    private $searchResultJourney = NULL;
    private $searchResultItinerary = NULL;


    public function __construct($id, $mail, $name, $surname, $address, $telephone) {
        $this->session_id = $id;
        $this->mail = $mail;
        $this->name = $name;
        $this->surname = $surname;
        $this->address = $address;
        $this->telephone = $telephone;
        $this->itineraryContext = NULL;
        $this->itinerary = NULL;
    }
    
    public function __sleep() {
        return array('session_id', 'mail', 'name', 'surname', 'address', 'telephone', 'searchResultItinerary', 'searchResultJourney', 'itineraryContext');
    }
    public function __wakeup() {
        
    }
    
    public function getRole(){ return "Customer"; }
    public function getName(){ return $this->name; }
    public function getSurname() {return $this->surname; }
    public function getAddress() {return $this->address; }
    public function getTelephone() {return $this->telephone; }
    public function getMail() {return $this->mail; }
    
    public function setAddress($newAddress) { }
    public function setTelephone($newTelephone) { }
    public function setJourneySearchResult(JourneySearchResult $searchResultJourney) {
        $this->searchResultJourney = $searchResultJourney;
    }
    public function setItinerarySearchResult(ItinerarySearchResult $searchResultItinerary) {
        $this->searchResultItinerary = $searchResultItinerary;
    }
    
    
    
    public function getJourney($id){
        if($this->searchResultJourney){
            return $this->searchResultJourney->getObject($id);
        }
        return NULL;
    }
    
    public function getItinerary($id = NULL){
        if($this->searchResultItinerary && $id != NULL){
            $this->itineraryContext = new ItineraryContext($this->searchResultItinerary->getObject($id));
        }
        return $this->itineraryContext->getItinerary();
    }
    
    public function getStay($idStay){
        $stays = $this->itineraryContext->getItinerary()->getStaySearchResult();
        return $stays->getObject($idStay);
    }
    
    public function getActivity($idStay, $idActivity){
        $itinerary = $this->itineraryContext->getItinerary();
        $stay = $itinerary->getStaySearchResult()->getObject($idStay);
        return $stay->getComponent($idActivity);
    }
    
    public function getAccomodation($idStay, $idAccomodation){
        $itinerary = $this->itineraryContext->getItinerary();
        $stay = $itinerary->getStaySearchResult()->getObject($idStay);
        return $stay->getComponent($idAccomodation);
    }
    
    public function getBrick($idBrick){
        $itinerary = $this->itineraryContext->getItinerary();
        return $itinerary->getBrick($idBrick);
    }
    
    public function getBrickActivity($idBrick, $idActivity){
        $itinerary = $this->itineraryContext->getItinerary();
        $brick = $itinerary->getBrick($idBrick);
        return $brick->getSelectedActivity($idActivity);
    }
    
    public function getBrickAccomodation($idBrick){
        $itinerary = $this->itineraryContext->getItinerary();
        return $itinerary->getBrick($idBrick)->getSelectedAccomodation();
    }
    
    
    
    /*
     * MANAGE ITINERARY
     */
    
    public function createItinerary($name, $description, $location){
        $itinerary = new PartialItinerary($this->mail, $name, $description, $location);
        $this->itineraryContext = new ItineraryContext($itinerary);
    }
    
    public function searchStays(){
        $itinerary = $this->itineraryContext->getItinerary();
        return $itinerary->getStaySearchResult();
    }
    
    public function addBrick($idTemplate){
        $itinerary = $this->itineraryContext->getItinerary();
        $itinerary->addBrick($idTemplate);
    }
    
    public function removeBrick($idBrick){
        $itinerary = $this->itineraryContext->getItinerary();
        $itinerary->removeBrick($idBrick);
    }
    
    public function addActivity($idStay, $idActivity){
        $itinerary = $this->itineraryContext->getItinerary();
        $brick = $itinerary->getBrick($idStay);
        $brick->addActivity($idActivity);
        return $brick->getActivity($idActivity);
    }
    
    public function removeActivity($idStay, $idActivity){
        $itinerary = $this->itineraryContext->getItinerary();
        $brick = $itinerary->getBrick($idStay);
        $brick->removeActivity($idActivity);
    }
    
    public function addAccomodation($idStay, $idAccomodation){
        $itinerary = $this->itineraryContext->getItinerary();
        $brick = $itinerary->getBrick($idStay);
        $brick->addAccomodation($idAccomodation);
        return $brick->getAccomodation($idAccomodation);
    }
    
    public function removeAccomodation($idStay){
        $itinerary = $this->itineraryContext->getItinerary();
        $brick = $itinerary->getBrick($idStay);
        $brick->removeActivity();
    }
    
//    public function configureStayParameter($optId, $valId){
//        $this->itineraryContext->configureStayParameter($optId, $valId);
//    }
//    
//    public function manageActivityInStay($stayId){
//        $this->context->manageActivityInStay($stayId);
//    }
//    
//    public function saveStay(){
//        $this->context->saveStay($this->stay);
//    }
}
?>
