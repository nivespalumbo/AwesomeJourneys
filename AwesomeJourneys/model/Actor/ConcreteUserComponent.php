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
    
    
    
    public function getItinerary($id = NULL){
        if($id != NULL){
            $this->itineraryContext = new ItineraryContext($this->searchResultItinerary->getObject($id));
        }
        return $this->itineraryContext->getItinerary();
    }
    
    public function createItinerary($name, $description, $location){
        $itinerary = new PartialItinerary($this->mail, $name, $description, $location);
        $this->itineraryContext = new ItineraryContext($itinerary);
    }
    
    
    
    public function searchStays(){
        $itinerary = $this->itineraryContext->getItinerary();
        return $itinerary->getStaySearchResult();
    }
    
    public function selectStay($idStay){
        $stays = $this->itineraryContext->getItinerary()->getStaySearchResult();
        return $stays->getObject($idStay);
    }
    
    public function addStay($idStay){
        $itinerary = $this->itineraryContext->getItinerary();
        $itinerary->addBrick($idStay);
    }
    
    
    
    public function searchActivities(){
        
    }
    
    public function selectActivity($idStay, $idActivity){
        
    }
    
    public function addActivity($idStay, $idActivity){
        
    }

     
    /*
     * STAY
     */
    
//    public function searchStay(){
//        $this->searchResultStay = new StaySearchResult();
//        $this->searchResultStay->searchStay();
//    }
//    
//    public function getStaySearchResult(){
//        return $this->searchResultStay;
//    }
//    
//    public function getStay($id){
//        return $this->searchResultStay->getObject($id);
//    }
//    
//    public function selectActivity($idStay, $idActivity){
//        return $this->searchResultStay->getObject($idStay)->getActivities()[$idActivity];
//    }
//    
//    public function selectAccomodation($idStay, $idAccomodation){
//        return $this->searchResultStay->getObject($idStay)->getAccomodations()[$idAccomodation];
//    }
    
    
    
    /*
     * ACTIVITY
     */
    
//    public function searchActivity($query = NULL){
//        $this->searchResultActivity = new ActivitySearchResult();
//        $this->searchResultActivity->search($query);
//    }
//    
//    public function getActivitySearchResult(){
//        return $this->searchResultActivity;
//    } 
//    
//    public function getActivity($id){
//        return $this->searchResultActivity->getObject($id);
//    }
    
    
    
    /*
     * ITINERARY
     */
    
//    public function createItinerary(){
//        $this->itineraryContext = new ItineraryContext($this->mail);
//    }
//    
//    public function provideBasicInfo($itName, $itDesc){
//        $itinerary = $this->itineraryContext->getItinerary();
//        $itinerary->provideBasicInfo($itName, $itDesc);
//    }
//    
//    public function insertStay($id){
//        $stayTemplate = $this->searchResultStay->getObject($id);
//        $this->itineraryContext->addBrick($stayTemplate);
//    }
//    
//    public function searchItinerary($query = NULL){
//        $this->searchResultItinerary = new ItinerarySearchResult();
//        $this->searchResultItinerary->search($query);
//    }
//    
//    public function getItinerarySearchResult(){
//        return $this->searchResultItinerary;
//    }
//    
//    public function getItinerary($id = NULL){
//        if($id == NULL){
//            return $this->itineraryContext->getItinerary();
//        }
//        else {
//            $this->itineraryContext = new ItineraryContext($this->mail, $this->searchResultItinerary->getObject($id));
//            return $this->itineraryContext->getItinerary();
//        }
//    }
//    
//    
//    
//    /*
//     * JOURNEY
//     */
//    public function searchJourney($query = NULL){
//        $this->searchResultJourney = new JourneySearchResult();
//        $this->searchResultJourney->search($query);
//    }
//    
//    public function getJourneySearchResult(){
//        return $this->searchResultJourney;
//    }
//    
//    public function getJourney($id){
//        return $this->searchResultJourney->getObject($id);
//    }
//    
//    
//    
//    public function addBrick($idStayTemplate){
//        $template = $this->searchResultStay->getObject($idStayTemplate);
//        $this->itineraryContext->addBrick($template);
//    }
//    
//    
    
//    public function configureStayParameter($optId, $valId){
//        $this->itineraryContext->configureStayParameter($optId, $valId);
//    }
//    
//    
//    
//    public function removeActivity($idList){
//        $this->itineraryContext->itineraryContext->removeActivity($idList);
//    }
//    
//    public function manageActivityInStay($stayId){
//        $this->context->manageActivityInStay($stayId);
//    }
//    
//    public function selectActivity($activityIdList, $stayId){
//        return $this->context->selectActivity($activityIdList, $stayId);
//    }
//    
//    public function saveStay(){
//        $this->context->saveStay($this->stay);
//    }
//    
}
?>
