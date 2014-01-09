<?php
include_once 'model/Itinerary/ItineraryComponent.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItineraryInHTML
 *
 * @author anto
 */
class ItineraryInHTML {
    private $Itinerary;
    private $itinerarySearchResult;
    
    public function __construct($Itinerary = NULL) {
        $this->Itinerary = $Itinerary;
    }
    
    public function setItinerarySearchResult($itinerarySearchResult){
        $this->itinerarySearchResult = $itinerarySearchResult;
    }
    
    public function getAllItinerary(){
        $ris = "";
        while($this->Itinerary = $this->model->fetch_object()){
            $ris = $ris.$this->get_itinerary();
        }
        return $ris;
    }
    
    public function get_itinerary(){
        echo "<img src='journeys/".$this->Itinerary->get_photo()."' />";
        echo "<h3>".$this->Itinerary->get_name()."</h3>";
        switch ($this->Itinerary->get_category()) {
          case 'cities':
             echo "<p class='category' style='background-color: #FF0000;'>Citt&agrave;</p>";
             break;
          case 'mountain' :
             echo "<p class='category' style='background-color: #00FF00;'>Montagna</p>";
             break;
        }
        echo "<p>".$this->Itinerary->get_description()."</p>";
     }
}

?>
