<?php

define("STAY", 0);
define("TRANSFER", 1);

/**
 *
 * @author Nives
 */
interface ItineraryBrick {
    public function getId();
    public function getStartLocation();
    public function getEndLocation();
    public function getType();
    
    public function setId($id);
}
