<?php $user = unserialize($_SESSION['utente']); ?>
    
<?php 
include_once 'partials/_login.php';
include_once 'partials/_personalmenu.php' 
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
                    echo "<div class='itinerary select_stages'>";
                    if($photo = $itinerary->getPhoto()){
                        echo "<img src='journeys/".$photo."' />";
                    }
                    echo "<h3>".$itinerary->getName()."</h3>";
                    echo "<p>".$itinerary->getDescription()."</p>";
                    echo "<div class='add_remove_to_stage'>"
                         . "<a href='index.php?op=manageItinerary&id=".$itinerary->getId()."' >Modifica</a>"
                         . "<a href='index.php?op=removeItinerary&id=".$itinerary->getId()."' >Elimina</a>"   
                       . "</div>";
                    echo "</div>";
                }
            }
            else{
                echo "<p>Nessun itinerario creato</p>";
            }
            ?>
			<div class="clear"></div>
        </div>
        <div id="viaggi">
            <?php
            if($this->model['journeys'] != NULL){
                while($journey = $this->model['journeys']->fetchObject()){
                   echo "<div class='viaggio select_stages'>";
                   $itinerary = $journey->getItinerary();
                   $photo = $itinerary->getPhoto();
                   if($photo != NULL){
                        echo "<img src='journeys/".$photo."' />";
                   }
                   echo "<h3>".$itinerary->getName()."</h3>";
                   echo "<p>".$itinerary->getDescription()."</p>";
                   echo "<p>Dal <b>".$journey->getAvailableFrom()."</b> al <b>".$journey->getAvailableTo()."</b></p>";
                   echo "<p style='color: #FF0000;'><b>".$journey->getPrice()." &euro;</b></p>";
                   echo '</div>';
                }
            }
            else{
                echo "<p>Nessun viaggio trovato</p>";
            }
            ?>
			<div class="clear"></div>
        </div>
    </div>
</div>