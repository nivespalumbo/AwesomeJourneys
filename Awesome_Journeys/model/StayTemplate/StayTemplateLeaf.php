<?php
include_once 'StayTemplateComponent.php';

interface StayTemplateLeaf extends StayTemplateComponent{
    public function getId();
    public function getEndLocation();
    public function getStartLocation();
    public function getLocation();
    public function getDuration();
    public function getVehicle();
    public function getDescription();
}

?>
