<?php
include_once 'model/StayTemplate/StayTemplateComponent.php';

interface ItineraryBrick {
    public function getId();
    public function getTemplate();
    public function getType();
    public function getStartLocation();
    public function getEndLocation();
    public function getStartDate();
    public function getEndDate();
    
    public function setId($id);
    public function setStartDate($startDate);
    public function setEndDate($endDate);
    
    public function addActivity(Activity $a);
    public function removeActivity($id);
    
    public function addAccomodation(Accomodation $a);
    public function removeAccomodation();
    
    public function addTransport(Transport $t);
    public function removeTransport();
    
//    public function selectGoing($transport);
//    public function selectReturn($transport);
//    public function setItineraryId($id);
    
//    public function save();
//    public function saveByConnection($db);
    
//    public function isContiguous($location, $date = NULL);

    
//    public function getReturn();
//    public function getGoing();
//    public function getSelectedTransport();
    
//    public function getStay($stayId);
}

