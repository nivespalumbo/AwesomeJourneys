<?php 
include_once '_login.php';
//include_once '_personalmenu.php' 
?>

<form action="index.php" method="GET">
    <!--label>Luogo</label><input type="text" name="location" /-->
    <label>Data partenza</label><input type="date" name="startDate" class="datepicker"/>
    <button type="submit" name="op" value="search">Cerca</button>
</form>

<div id="risultati_ricerca">
    <?php
        if(isset($this->model)){ ?>
            <div class="tabs">
                <ul>
                    <li><h4><a href="#itinerari">Itinerari</a></h4></li>
                    <li><h4><a href="#viaggi">Viaggi</a></h4></li>
                </ul>
                <div id="itinerari">
                    <?php
                    include_once 'Oggetti/ItineraryInHTML.php';

                    if($this->model['itineraries'] != NULL){
                        while($itinerary = $this->model['itineraries']->fetchObject()){
                            $view = new ItineraryInHTML($itinerary);
                            $view->getItinerary();
                        }
                    }
                    else{
                        echo "<p>Nessun itinerario trovato</p>";
                    }
                    ?>
                </div>
                <div id="viaggi">
                    <?php
                    include_once 'Oggetti/JourneyInHTML.php';

                    if($this->model['journeys'] != NULL){
                        while($journey = $this->model['journeys']->fetchObject()){
                           $view = new JourneyInHTML($journey);
                           $view->get_journey();
                        }
                    }
                    else{
                        echo "<p>Nessun viaggio trovato</p>";
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
</div>