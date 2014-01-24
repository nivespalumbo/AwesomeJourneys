<?php $user = unserialize($_SESSION['utente']); ?>
<?php 
include_once '_login.php';
include_once '_personalmenu.php' 
?>
<div id="my_itineray">
<h2><?php echo $this->model->getName(); ?></h2>
<p><?php echo $this->model->getDescription(); ?></p>
</div>
<div id="stage">
<h3>Tappe</h3><a href="index.php?op=searchStay" >Search stay</a>
</div>

<div id="stages">
    <?php
    $tappe = $this->model->getItineraryBricks();
    foreach($tappe as $tappa){
        echo "<div id='select_stages'>"
            . "<label>".$tappa->getTemplate()->getName()."</label>"
            . "<p>".$tappa->getTemplate()->getDescription()."</p>"
            . "<div>"
            . "<div class='activity_title'><h3>Attivita'</h3></div>"; 
        $attivitaPreviste = $tappa->getActivities();
        $attivitaSelezionate = $tappa->getSelectedActivities();
        foreach($attivitaPreviste as $attivita){
            echo "<div class='activity'>"
                 . "<input type='checkbox' name='idActivity[]' value='".$attivita->getId()."'";
            if(array_key_exists($attivita->getId(), $attivitaSelezionate)){ echo "checked" ; }
            echo " />";
            echo "<b>".$attivita->getName()."</b>"
                 . "<p>".$attivita->getDescription()."</p>"
                 ."</div>";
        }
        echo"</div>";
        
        echo "<div>
                    <div class='activity_title'><h3>Pernottamenti disponibili</h3></div>                ";
        $accomodations = $tappa->getAccomodations();
        foreach($accomodations as $a){
            echo "<div class='activity'>"
                 . "<input type='radio' name='idAccomodation' value='".$a->getId()."'";
            if($a->getId() == $tappa->getSelectedAccomodation()){ echo "checked" ; }
            echo " />";
            echo "<b>".$a->getName()."</b>"
                 . "<div><span>Tipo: ".$a->getAccomodationType()."</span>"
                 . "<span>Location: ".$a->getLocation()."</span></div>"
                 . "</div>";
        }
        echo "</div></div>";
    }
    ?>
    </ul>
</div>