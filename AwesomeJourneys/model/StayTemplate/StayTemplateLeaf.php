<?php
include_once 'StayTemplateComponent.php';

interface StayTemplateLeaf extends StayTemplateComponent{
    public function getDuration();
    public function getVehicle();
    public function getDescription();
}

?>
