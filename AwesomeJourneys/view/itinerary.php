<h2><?php echo $this->model->getName(); ?></h2>
<p><?php echo $this->model->getDescription(); ?></p>

<h3>Tappe</h3><a href="index.php?op=searchStay" >Search stay</a>

<form action="index.php" method="POST">
<div>
    <?php
    $tappe = $this->model->getItineraryBricks();
    foreach($tappe as $tappa){
        echo "<div>"
            . "<label>".$tappa->getTemplate()->getName()."</label>"
            . "<p>".$tappa->getTemplate()->getDescription()."</p>"
            . "<div>"
            . "<h3>Attività</h3>"; 
        echo "<ul>";
        $attivitaPreviste = $tappa->getActivities();
        $attivitaSelezionate = $tappa->getSelectedActivities();
        foreach($attivitaPreviste as $attivita){
            echo "<li>"
                 . "<input type='checkbox' name='idActivity[]' value='".$attivita->getId()."'";
            if(array_key_exists($attivita->getId(), $attivitaSelezionate)){ echo "checked" ; }
            echo " />";
            echo "<b>".$attivita->getName()."</b>"
                 . "<p>".$attivita->getDescription()."</p>"
                 . "</li>";
        }
        echo "</ul>"
            . "</div>";
        
        echo "<div>
                <h3>Pernottamenti disponibili</h3>
                <ul>";
        $accomodations = $tappa->getAccomodations();
        foreach($accomodations as $a){
            echo "<li>"
                 . "<input type='radio' name='idAccomodation' value='".$a->getId()."'";
            if($a->getId() == $tappa->getSelectedAccomodation()){ echo "checked" ; }
            echo " />";
            echo "<b>".$a->getName()."</b>"
                 . "<div><span>Tipo: ".$a->getAccomodationType()."</span>"
                 . "<span>Location: ".$a->getLocation()."</span></div>"
                 . "</li>";
        }
        echo "</div></div>";
    }
    ?>
    </ul>
</div>
<button type="submit" name="op" value="saveItinerary">Salva</button>
</form>