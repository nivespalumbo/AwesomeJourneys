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
            echo "<div class='activity'>";
            echo "<b>".$attivita->getName()."</b>"
                 . "<p>".$attivita->getDescription()."</p>";
            if(array_key_exists($attivita->getId(), $attivitaSelezionate)){
                echo "<a href='index.php?op=modifyActivity&id=".$attivita->getId()."' >Modifica</a>";
                echo "<a href='index.php?op=deleteActivity&id=".$attivita->getId()."' >Elimina</a>";
            }
            else {
                echo "<div class='add_remove_to_stage'><a href='index.php?op=addActivity&id=".$attivita->getId()."' >Aggiungi alla tappa</a></div>";
            }
            echo "</div>";
        }
        echo"</div>";
        
        echo "<div>
                    <div class='activity_title'><h3>Pernottamenti disponibili</h3></div>                ";
        $accomodations = $tappa->getAccomodations();
        foreach($accomodations as $a){
            echo "<div class='activity'>";
            echo "<b>".$a->getName()."</b>"
                 . "<div><span>Tipo: ".$a->getAccomodationType()."</span>"
                 . "<span>Location: ".$a->getLocation()."</span></div>";
            if($a->getId() != $tappa->getSelectedAccomodation()){ 
                echo "<div class='add_remove_to_stage'><a href='index.php?op=chooseAccomodation&id=".$a->getId()."' >Scegli questo pernottamento</a></div>";
            }
            else {
                echo "<div class='add_remove_to_stage'><a href='index.php?op=removeAccomodation&id=".$a->getId()."' >Rimuovi</a></div>";
            }
            echo "</div>";
        }
        echo "</div></div>";
    }
    ?>
</div>