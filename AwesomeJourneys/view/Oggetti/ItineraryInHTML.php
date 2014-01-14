<?php
include_once 'model/Itinerary/ItineraryState.php';
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
            $ris = $ris.$this->getItinerary();
        }
        return $ris;
    }
    
    public function getItinerary(){
        $photo = $this->Itinerary->getPhoto();
        if($photo != NULL){
            echo "<img src='journeys/".$photo."' />";
        }
        $name = $this->Itinerary->getName();
        echo "<h3>".$name."</h3>";
        /*switch ($this->Itinerary->get_category()) {
          case 'cities':
             echo "<p class='category' style='background-color: #FF0000;'>Citt&agrave;</p>";
             break;
          case 'mountain' :
             echo "<p class='category' style='background-color: #00FF00;'>Montagna</p>";
             break;
        }*/
        $description = $this->Itinerary->getDescription();
        echo "<p>".$description."</p>";
     }
}

?>
