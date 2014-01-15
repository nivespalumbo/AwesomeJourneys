<?php
    while($journey = $this->model->fetch_object()){
       $itinerary = $journey->getItinerary();
       echo "<img src='journeys/".$itinerary->getPhoto()."' />";
    }
?>
<h2>Le nostre offerte</h2>
