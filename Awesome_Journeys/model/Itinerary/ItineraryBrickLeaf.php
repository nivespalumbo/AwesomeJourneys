<?php

interface ItineraryBrickLeaf extends ItineraryComponent{
    public function configureStayParameter($optId, $valId);
    public function getActivity();
    public function getAccomodation();
    public function getTransport();
    public function getId();
    public function addActivity($activity);
    public function addTransport($transport);
    public function addAccomodation($accomodation);
    public function removeActivity($idList);
    
}

?>
