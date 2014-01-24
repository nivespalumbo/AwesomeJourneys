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
                    echo "<a href='index.php?op=selectItinerary&id=".$itinerary->getId()."' >Modifica</a>";
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
            if($this->model['journeys'] != NULL){
                while($journey = $this->model['journeys']->fetchObject()){
                   echo "<div class='viaggio'>";
                   $itinerary = $journey->getItinerary();
                   $photo = $itinerary->getPhoto();
                   if($photo != NULL){
                        echo "<img src='journeys/".$photo."' />";
                   }
                   echo "<h3>".$itinerary->getName()."</h3>";
                   echo "<p>".$itinerary->getDescription()."</p>";
                   echo "<p>Dal <b>".$journey->getStartDate()."</b> al <b>".$journey->getEndDate()."</b></p>";
                   echo "<p style='color: #FF0000;'><b>".$journey->getPrice()." &euro;</b></p>";
                   echo '</div>';
                }
            }
            else{
                echo "<p>Nessun viaggio trovato</p>";
            }
            ?>
        </div>
    </div>
</div>