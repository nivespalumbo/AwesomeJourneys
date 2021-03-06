<form action="index.php" method="GET">
    <label>Luogo</label><input type="text" name="location" />
    <label>Data partenza</label><input type="text" name="startDate" class="datepicker"/>
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
                    if($this->model['itineraries'] != NULL){
                        while($itinerary = $this->model['itineraries']->fetchObject()){
							echo "<div class='viaggio grid'>";
                            $photo = $itinerary->getPhoto();
                            if($photo != NULL){
                                echo "<img src='images/journeys/".$photo."' />";
                            }
                            echo "<h3><a href='index.php?op=selectItinerary&id=".$itinerary->getId()."' >".$itinerary->getName()."</a></h3>";
                            echo "<p>".$itinerary->getDescription()."</p></div>";
                        }
                    }
                    else{
                        echo "<p>Nessun itinerario trovato</p>";
                    }
                    ?>
					<div class="clear"></div>
                </div>
                <div id="viaggi">
                    <?php
                    if($this->model['journeys'] != NULL){
                        while($journey = $this->model['journeys']->fetchObject()){
                           echo "<div class='viaggio grid'>";
                           $itinerary = $journey->getItinerary();
                           $photo = $itinerary->getPhoto();
                           if($photo != NULL){
                                echo "<img src='images/journeys/".$photo."' />";
                           }
                           echo "<h3><a href='index.php?op=selectJourney&id=".$journey->getId()."' >".$itinerary->getName()."</a></h3>";
                           echo "<p>".$itinerary->getDescription()."</p>";
                           echo "<p>Dal <b>".$journey->getStartDate()."</b> al <b>".$journey->getEndDate()."</b></p>";
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
        <?php } ?>
</div>