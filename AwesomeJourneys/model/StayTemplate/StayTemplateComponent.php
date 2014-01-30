<?php
include_once 'model/Enumerations/ComponentType.php';

interface StayTemplateComponent {
    public function getId();
    public function getType();
    public function getName();
    public function getDescription();
    
//    public function getStartLocation();
//    public function getEndLocation();
//    public function getStartDate();
//    public function getEndDate();
    
    public function getComponentsOfType($type);
    
    public function setName($name);
    public function setDescription($description);
//    public function setStartLocation($location);
//    public function setEndLocation($location);
//    public function setStartDate($endDate);
//    public function setEndDate($startDate);
    
    public function isComposite();
    
    public function addComponent(StayTemplateComponent $component);
    public function removeComponent($id);
}
