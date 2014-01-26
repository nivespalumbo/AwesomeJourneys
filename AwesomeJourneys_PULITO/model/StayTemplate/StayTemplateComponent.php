<?php

define("STAY_TEMPLATE", 0);
define("TRANSPORT", 1);
define("ACTIVITY", 2);
define("ACCOMODATION", 3);

/**
 *
 * @author Nives
 */
interface StayTemplateComponent {
    public function getId();
    public function getType();
    
    public function addComponent($key, StayTemplateComponent $object);
    public function getComponent($key);
    public function removeComponent($key);
    
    public function getComponentsOfType($type);
}
