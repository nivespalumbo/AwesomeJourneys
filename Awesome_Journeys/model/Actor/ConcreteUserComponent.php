<?php
include_once 'model/Itinerary/ItineraryContext.php';
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
    private $searchResultStay;
    private $searchResultActivity;
    private $searchResultItineraryOrJourney;


    public function __construct($id, $mail, $name, $surname, $address, $telephone) {
        $this->session_id = $id;
        $this->mail = $mail;
        $this->name = $name;
        $this->surname = $surname;
        $this->address = $address;
        $this->telephone = $telephone;
        $this->searchResultStay = NULL;
        $this->searchResultActivity = NULL;
        $this->searchResultItineraryOrJourney = NULL;
        
        $this->context = new ItineraryContext();
    }
    public function getRole(){
        return "Customer";
    }
    
    public function createItinerary(){
        $this->context->nuovoItinerario();
    }
    
    public function privideBasicInfo($itName, $itDesc, $itTagList, $itCategory){
        $this->context->privideBasicInfo($itName, $itDesc, $itTagList, $itCategory);
    }
    
    public function getName(){ return $this->name; }
    public function getSurname() {return $this->surname; }
    public function getAddress() {return $this->address; }
    public function getTelephone() {return $this->telephone; }
    public function getMail() {return $this->mail; }
    public function getStaySearchResult(){return $this->searchResultStay;}
    public function setAddress($newAddress) {
       # TODO
    }
    
    public function setStaySearchResult(){
        $this->searchResultStay = new StaySearchResult();
        $this->searchResultStay->search(null);
    }
    
    public function selectStay($id){
        $stayTemplate = $this->searchResultStay->selectStay($id);
        $this->context->nuovaTappa($stayTemplate);
    }
    
    public function setSearchResultItineraryOrJourney(){
        $this->searchResultItineraryOrJourney = new JourneySearchResult();
    }
    
    public function configureStayParameter($optId, $valId){
        $this->context->configureStayParameter($optId, $valId);
    }
    
    public function searchActivity(){
        $this->searchResultActivity = new ActivitySearchResult();
        $this->searchResultActivity->search();
        return $this->searchResultActivity;
    }
    
    public function removeActivity($idList){
        $this->context->itineraryContext->removeActivity($idList);
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
    
    public function setTelephone($newTelephone) {
       # TODO
    }
    
    public function __sleep() {
        return array('session_id', 'mail', 'name', 'surname', 'address', 'telephone', 'itineraryContext', 'searchResultStay', 'searchResultActivity', 'searchResultItineraryOrJourney');
    }
    
    public function __wakeup() {
        $this->context = new ItineraryContext();
    }
}
?>
