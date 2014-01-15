<?php
include_once 'model/Actor/UserComponent.php';

if(!isset($_SESSION['utente']))
    header("Location:index.php?op=login");
else {
    $user = unserialize($_SESSION['utente']);
    /*if($user->getRole() == 'Customer')
        header("Location:index.php?op=errore&tipo=accesso");*/
}
?>
    
    <?php include_once '_personalmenu.php' ?>
                
                <div class="two-columns">
                    <div class="first-half">
                        <h2>Itinerari</h2>
                        <?php
                        include_once 'Oggetti/ItineraryInHTML.php';

                        if($this->model['itineraries'] != NULL){
                            while($itinerary = $this->model['itineraries']->fetch_object()){
                                $view = new ItineraryInHTML($itinerary);
                                $view->getItinerary();
                            }
                        }
                        else{
                            echo "<p>Nessun itinerario creato</p>";
                        }
                        ?>
                    </div>
                    <div class="second-half">
                        <h2>Viaggi</h2>
                        <?php
                        include_once 'Oggetti/JourneyInHTML.php';

                        if($this->model['journeys'] != NULL){
                            while($journey = $this->model['journeys']->fetch_object()){
                               $view = new JourneyInHTML($journey);
                               $view->get_journey();
                            }
                        }
                        else{
                            echo "<p>Nessun viaggio creato</p>";
                        }
                        ?>
                    </div>
                </div>