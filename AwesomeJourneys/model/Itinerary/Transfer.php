<?php
include_once 'ItineraryBrick.php';
include_once 'model/Enumerations/ItineraryBrickType.php';

class Transfer implements ItineraryBrick{
    private $id;
    private $stayId;
    private $itineraryId;
    private $name;
    private $description;
    private $startLocation;
    private $endLocation;
    private $trasportSelected;//array contenente tutti i trasporti
    private $transferTemplate;
    private $startDate;
    private $endDate;

    public function __construct($stayId, $transferTemplate) {
        $this->stayId = $stayId;
        $this->trasportSelected = NULL;
        
        $this->transferTemplate = $transferTemplate;
        
        $this->startLocation = $transferTemplate->getStartLocation();
        $this->endLocation = $transferTemplate->getEndLocation();
    }
    
    public function __sleep(){
        return array('stayId', 'itineraryId', 'name', 'description', 'startLocation', 'endLocation', 'transportSelected', 'transferTemplate', 'startDate', 'endDate');
    }
    public function __wakeup() {
        }
    
    public static function getTransfer($idTransfer, $idItinerary){
        return NULL;
    }
    
    public function addAccomodation($idAccomodation) {
        return FALSE;
    }

    public function addActivity($idActivity) {
        return FALSE;
    }

    public function getAccomodations() {
        return FALSE;
    }

    public function getActivities() {
        return FALSE;
    }

    public function getActivity($idActivity) {
        return FALSE;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function getEndLocation() {
        return $this->endLocation;
    }

    public function getId() {
        return $this->id;
    }

    public function getItineraryId() {
        return $this->itineraryId;
    }

    public function getSelectedAccomodation() {
        return FALSE;
    }

    public function getSelectedActivities() {
        return FALSE;
    }
    public function getSelectedActivity($idActivity) {
        return FALSE;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getStartLocation() {
        return $this->startLocation;
    }

    public function getTemplate() {
        return $this->transferTemplate;
    }

    public function removeAccomodation() {
        return FALSE;
    }

    public function removeActivity($idActivity) {
        return FALSE;
    }

    public function setSelectedAccomodation($idAccomodation) {
        return FALSE;
    }

    public function setSelectedActivities(\Activity $activity) {
        return FALSE;
    }

    
//    public function setLocation($location){
//        return FALSE;
//    }
//    
//    public function configureStayParameter($optId, $valId){
//        //$this->options[$optId] = $valId;
//    }
//    
//    public function manageActivityInStay($listActivityId){
//        return FALSE;
//    }
//    
//    public function ricercaTappa($stayId) {
//        if($this->stayId == $stayId)
//            return NULL;
//        return $this;
//    }
//
//    public function getActivity($idActivity) {
//        return FALSE;
//    }
//
//    public function getAccomodations() {
//        return FALSE;
//    }
//
//    public function getId() {
//        return $this->stayId;
//    }
//
//    public function selectActivity($idActivity) {
//        return FALSE;
//    }
//    
//    public function getTemplate() {
//        return FALSE;
//    }
//
//    public function removeAccomodation() {
//        return FALSE;
//    }
//
//    public function setSelectedAccomodation($idAccomodation) {
//        return FALSE;
//    }
//
//    public function setSelectedActivities(Activity $activity) {
//        return FALSE;
//    }
//
//        public function getLocation() {
//        return FALSE;
//    }
//
//    public function selectAccomodation($accomodation) {
//        return FALSE;
//    }
//
//    public function selectActivities($activity) {
//        return FALSE;
//    }
//
//    public function selectTransports($transport) {
//        $this->transportComponents[$transport->getId()] = $transport;
//        return TRUE;
//    }
//
//    public function getEndLocation() {
//        return $this->endLocation;
//    }
//
//    public function getStartLocation() {
//        return $this->startLocation;
//    }
//
//    public function removeActivity($idList) {
//        return FALSE;
//    }
//    
//    public function getStay($stayId) {
//        if($this->stayId != $stayId){
//            return FALSE;
//        }else{
//            return $this;
//        }
//    }
//
//    public function addComponent(StayTemplateComponent $component) {
//        return FALSE;
//    }
//
//    public function getActivities() {
//        return FALSE;
//    }
//
//    public function getComposite() {
//        return FALSE;
//    }
//
//    public function getTransports() {
//        $this->transferTemplate->getTransports();
//    }
//
//    public function getType() {
//        return TRANSFER;
//    }
//
//    public function newItineraryBick() {
//        return FALSE;
//    }
//
//    public function removeComponent($id) {
//        return FALSE;
//    }
//
//    public function setEndLocation($location) {
//        $this->endLocation = $location;
//    }
//
//    public function setStartLocation($location) {
//        $this->startLocation = $location;
//    }
//
//    public function getGoing() {
//        return FALSE;
//    }
//
//    public function getReturn() {
//        return FALSE;
//    }
//
//    public function getSelectedAccomodation() {
//        return FALSE;
//    }
//
//    public function getSelectedActivities() {
//        return FALSE;
//    }
//
//    public function isComposite() {
//        return FALSE;
//    }
//
//    public function selectGoing($transport) {
//        return FALSE;
//    }
//
//    public function selectReturn($transport) {
//        return FALSE;
//    }
//    
//    public function getSelectedTransport(){
//        return $this->trasportSelected;
//    }
//    
//    public function getDescription() {
//        return $this->description;
//    }
//
//    public function getName() {
//        return $this->name;
//    }
//
//    public function setDescription($description) {
//        $this->description = $description;
//    }
//
//    public function setName($name) {
//        $this->name = $name;
//    }
//
//    public function getEndDate() {
//        return $this->endDate;
//    }
//
//    public function getStartDate() {
//        return $this->startDate;
//    }
//
//    public function setEndDate($endDate) {
//        $this->endDate = $endDate;
//    }
//
//    public function setStartDate($startDate) {
//        $this->startDate = $startDate;
//    }
//
//    public function save() {
//        
//    }
//
//    public function saveByConnection($db) {
//        
//    }
//
//   public function getItineraryId() {
//        return $this->itineraryId;
//    }
//
//    public function setItineraryId($id) {
//        $this->itineraryId = $id;
//    }
//
//    public function isContiguous($location, $date = NULL) {
//        
//    }

}
