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
    public function updateActivity($idActivity, $date, $persons);
    public function removeActivity($id);
    
    public function addAccomodation(Accomodation $a);
    public function updateAccomodation($date, $duration);
    public function removeAccomodation();
    
    public function addTransport(Transport $t);
    public function removeTransport();
    
//    public function isContiguous($location, $date = NULL);

}

