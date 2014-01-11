<?php
include_once 'ItineraryInHTML.php';
include_once 'model/Journey/Journey.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JourneyInHTML
 *
 * @author anto
 */
class JourneyInHTML {
    private $journey;
    private $itineraryInHTML;
    
    public function __construct($journey) {
        $this->journey = $journey;
        $this->itineraryInHTML = new ItineraryInHTML($journey->getItinerary());
    }
    
    public function get_journey(){
       echo "<div class='viaggio'>";
       $this->itineraryInHTML->getItinerary();
       echo "<p>Dal <b>".$this->journey->getStartDate()."</b> al <b>".$this->journey->getEndDate()."</b></p>";
       echo "<p style='color: #FF0000;'><b>".$this->journey->getPrice()." &euro;</b></p>";
       echo '</div>';
    }
}

?>
