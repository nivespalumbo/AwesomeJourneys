<?php

/**
 * Description of Journey
 *
 * @author Nives
 */
class Journey {
    protected $id;
    protected $startDate;
    protected $endDate;
    protected $itinerary;
    protected $creator;
    
    function __construct($id, $startDate, $endDate, CompleteItinerary $itinerary, $creator) {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->itineraryId = $itinerary;
        $this->creator = $creator;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function getItinerary() {
        return $this->itinerary;
    }

    public function getCreator() {
        return $this->creator;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    public function setItinerary(CompleteItinerary $itinerary) {
        $this->itineraryId = $itinerary;
    }

    public function setCreator($creator) {
        $this->creator = $creator;
    }



}
