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
    
    public function setStaySearchResult(StaySearchResult $staySearchResult) {
        $this->staySearchResult = $staySearchResult;
    }

    public function setActivitySearchResult(ActivitySearchResult $activitySearchResult) {
        $this->activitySearchResult = $activitySearchResult;
    }

    public function setItinerarySearchResult(ItinerarySearchResult $itinerarySearchResult) {
        $this->itinerarySearchResult = $itinerarySearchResult;
    }

    public function setJourneySearchResult(JourneySearchResult $journeySearchResult) {
        $this->journeySearchResult = $journeySearchResult;
    }
    
    public function getItinerary($id = NULL){
        if($this->searchResultItinerary && $id != NULL){
            $this->itineraryContext = new ItineraryContext($this->searchResultItinerary->getObject($id));
        }
        return $this->itineraryContext->getItinerary();
    }
    
    public function getJourney($id){
        if($this->searchResultJourney){
            return $this->searchResultJourney->getObject($id);
        }
        return NULL;
    }
    
    public function getActivityTemplate($id){
        
    }
    
    public function getActivity(){
//        if($idStay != NULL){
//            if($this->searchResultStay){
//                return $this->searchResultStay->getObject($idStay)->getComponent($id);
//            }
//        }
//        else if($this->searchResultActivity){
//            return $this->searchResultActivity->getObject($id);           
//        }
//        return NULL;
    }
    
    public function getBrick($id){
        $itinerary = $this->itineraryContext->getItinerary();
        return $itinerary->getBrick($id);
    }
    
    public function getStayTemplate($id){
        if($this->searchResultStay){
            return $this->searchResultStay->getObject($id);
        }
        return NULL;
    }
    
    public function getAccomodation($idStay, $idAccomodation){
        if($this->searchResultStay){
            return $this->searchResultStay->getObject($idStay)->getComponent($idAccomodation);
        }
        return NULL;
    }
    
    
    
    
    /*
     * MANAGE ITINERARY
     */
    
    public function createItinerary($name, $description){
        $itinerary = new PartialItinerary(NULL, $name, $description, $creator);
        $this->itineraryContext = new ItineraryContext($itinerary);
    }
    
    public function searchStays(){
        $this->searchResultStay = new StaySearchResult();
        $this->searchResultStay->searchStay();
        return $this->searchResultStay;
    }
    
    public function searchActivities(){
        $this->searchResultActivity = new ActivitySearchResult();
        $this->searchResultActivity->search();
        return $this->searchResultActivity;
    }
    
    public function addBrick($idTemplate){
        $itinerary = $this->itineraryContext->getItinerary();
        if($stayTemplate = $this->staySearchResult->getObject($idTemplate)){
            $itinerary->addBrick($stayTemplate);
        }
    }
    
    public function removeBrick($idBrick){
        $itinerary = $this->itineraryContext->getItinerary();
        $itinerary->removeBrick($idBrick);
    }
    
    public function addActivity($idStay, $idActivity){
        $itinerary = $this->itineraryContext->getItinerary();
        $brick = $itinerary->getBrick($idStay);
        $activity = $brick->getTemplate()->getComponent($idActivity);
        $brick->addActivity($activity);
    }
    
    public function addActivityFromTemplate($idStay, $idActivityTemplate){
        $activityTemplate = $this->searchResultActivity->getObject($idActivityTemplate);
        $brick = $this->itineraryContext->getItinerary()->getBrick($idStay);
        $activity = new Activity(NULL, NULL, NULL, $activityTemplate->getId(), $activityTemplate->getName(), $activityTemplate->getDescription(), $activityTemplate->getLocation(), $activityTemplate->getAddress(), $activityTemplate->getAvailableFrom(), $activityTemplate->getAvailableTo());
        $brick->addActivity($activity);
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
    
    

    
    
    public function __sleep() {
        return array('sessionId', 'name', 'surname', 'address', 'telephone', 'mail', 'staySearchResult', 'activitySearchResult', 'itinerarySearchResult', 'journeySearchResult', 'itineraryContext');
    }

    public function __wakeup() {
        
    }
}
