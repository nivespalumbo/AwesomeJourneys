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
    
<?php 
include_once '_login.php';
include_once '_personalmenu.php' 
?>

<div id='content'>
    <div class="tabs">
        <ul>
            <li><h4><a href="#itinerari">Itinerari</a></h4></li>
            <li><h4><a href="#viaggi">Viaggi</a></h4></li>
        </ul>
        <div id="itinerari">
            <?php
            if($this->model['itineraries'] != NULL){
                while($itinerary = $this->model['itineraries']->fetchObject()){
                    echo "<div class='itinerary'>";
                    if($photo = $itinerary->getPhoto()){
                        echo "<img src='journeys/".$photo."' />";
                    }
                    echo "<h3>".$itinerary->getName()."</h3>";
                    echo "<p>".$itinerary->getDescription()."</p>";
                    echo "<a href='index.php?op=modifyItinerary&id=".$itinerary->getId()."' >Modifica</a>";
                    echo "</div>";
                }
            }
            else{
                echo "<p>Nessun itinerario creato</p>";
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
                echo "<p>Nessun viaggio creato</p>";
            }
            ?>
        </div>
    </div>
</div>