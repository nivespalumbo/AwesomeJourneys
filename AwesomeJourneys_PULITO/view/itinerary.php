<div id="my_itineray">
<h2><?php echo $this->model->getName(); ?></h2>
<p><?php echo $this->model->getDescription(); ?></p>
</div>

<div id="stages">
    <h3>Tappe</h3>
    <?php
    $tappe = $this->model->getItineraryBricks();
    foreach($tappe as $tappa){
        echo "<div id='select_stages'>"
            . "<label>".$tappa->getTemplate()->getName()."</label>"
            . "<p>".$tappa->getTemplate()->getDescription()."</p>"
            . "<div>"
            . "<div class='activity_title'><h3>Attivita'</h3></div>"; 
        $attivitaSelezionate = $tappa->getSelectedActivities();
        foreach($attivitaPreviste as $attivita){
            echo "<div class='activity'>";
            echo "<b>".$attivita->getName()."</b>"
               . "<p>".$attivita->getDescription()."</p>";
            echo "</div>";
        }
        echo"</div>";
        
        echo "<div>
                    <div class='activity_title'><h3>Pernottamenti disponibili</h3></div>";
        $accomodations = $tappa->getAccomodations();
        foreach($accomodations as $a){
            echo "<div class='activity'>";
            echo "<b>".$a->getName()."</b>"
                 . "<div><span>Tipo: ".$a->getAccomodationType()."</span>"
                 . "<span>Location: ".$a->getLocation()."</span></div>";
            echo "</div>";
        }
        echo "</div></div>";
    }
    ?>
</div>