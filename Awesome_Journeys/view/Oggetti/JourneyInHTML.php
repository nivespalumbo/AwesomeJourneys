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
        $this->itineraryInHTML = new ItineraryInHTML($journey->get_itinerary());
    }
    
    public function get_journey(){
       echo "<div class='viaggio'>";
       $this->itineraryInHTML->get_itinerary();
       echo "<p>Dal <b>".$this->journey->get_start_date()."</b> al <b>".$this->journey->get_end_date()."</b></p>";
       echo "<p style='color: #FF0000;'><b>".$this->journey->get_price()." &euro;</b></p>";
       echo '</div>';
    }
}

?>
