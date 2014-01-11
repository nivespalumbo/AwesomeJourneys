<?php
include_once 'model/StayTemplate/StayTemplateComponent.php';

interface ItineraryBrick extends StayTemplateComponent{
    //public function configureStayParameter($optId, $valId);
    public function selectActivities($activities);
    public function selectAccomodation($accomodation);
    public function selectGoing($transport);
    public function selectReturn($transport);
    public function setItineraryId($id);
    //public function removeActivity($idList);
    
    public function save();
    public function saveByConnection($db);
    
    public function isContiguous($location, $date = NULL);

    public function getSelectedActivities();
    public function getReturn();
    public function getGoing();
    public function getSelectedTransport();
    public function getSelectedAccomodation();
    public function getItineraryId();
    public function getStay($stayId);
    
}

