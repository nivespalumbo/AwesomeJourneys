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
    private $itinerary;
    private $searchResultStay = NULL;
    private $searchResultActivity = NULL;
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
    
    public function getRole(){ return "Customer"; }
    public function getName(){ return $this->name; }
    public function getSurname() {return $this->surname; }
    public function getAddress() {return $this->address; }
    public function getTelephone() {return $this->telephone; }
    public function getMail() {return $this->mail; }
    public function setAddress($newAddress) {
       # TODO
    }
    public function setTelephone($newTelephone) {
       # TODO
    }
    
    public function provideBasicInfo($itName, $itDesc){
        $itinerary = $this->itineraryContext->getItinerary();
        $itinerary->provideBasicInfo($itName, $itDesc);
    }
    
    public function createItinerary(){
        $this->itineraryContext = new ItineraryContext($this->mail);
    }
    
    public function getItinerary(){
        return $this->itineraryContext->getItinerary();
    }
    
    public function searchStay(){
        $this->searchResultStay = new StaySearchResult();
        $this->searchResultStay->search();
        return $this->searchResultStay;
    }
    
    public function searchActivity($query = NULL){
        $this->searchResultActivity = new ActivitySearchResult();
        $this->searchResultActivity->search($query);
        return $this->searchResultActivity;
    }
    
    public function searchItineraries($query = NULL){
        $this->searchResultItinerary = new ItinerarySearchResult();
        $this->searchResultItinerary->searchItinerary($query);
        return $this->searchResultItinerary;
    }
    
    public function searchJourneys($query = NULL){
        $this->searchResultJourney = new JourneySearchResult();
        $this->searchResultJourney->searchJourney($query);
        return $this->searchResultJourney;
    }
//    public function setStaySearchResult(){
//        $this->searchResultStay = new StaySearchResult();
//        $this->searchResultStay->search(null);
//    }
    
    public function selectStay($id){
        $stayTemplate = $this->searchResultStay->selectStay($id);
        $this->itineraryContext->nuovaTappa($stayTemplate);
    }
    
//    public function setSearchResultJourney(){
//        $this->searchResultJourney = new JourneySearchResult();
//    }
//    
//    public function setSearchResultItinerary(){
//        $this->searchResultItinerary = new ItinerarySearchResult();
//    }
    
    public function configureStayParameter($optId, $valId){
        $this->itineraryContext->configureStayParameter($optId, $valId);
    }
    
    
    
    public function removeActivity($idList){
        $this->itineraryContext->itineraryContext->removeActivity($idList);
    }
    
    public function manageActivityInStay($stayId){
        $this->context->manageActivityInStay($stayId);
    }
    
    public function selectActivity($activityIdList, $stayId){
        return $this->context->selectActivity($activityIdList, $stayId);
    }
    
    public function saveStay(){
        $this->context->saveStay($this->stay);
    }
    
    
    
    
    
    public function __sleep() {
        return array('session_id', 'mail', 'name', 'surname', 'address', 'telephone', 'searchResultStay', 'searchResultActivity', 'searchResultItinerary', 'searchResultJourney', 'itineraryContext', 'itinerary');
    }
    
    public function __wakeup() {
        //$this->context = new ItineraryContext($this->mail);
    }
}
?>
