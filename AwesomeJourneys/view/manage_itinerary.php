<?php $user = unserialize($_SESSION['utente']); ?>
<?php 
include_once 'partials/_login.php';
include_once 'partials/_personalmenu.php' 
?>
<div id="content">
    <div id="my_itineray">
        <h2><?php echo $this->model->getName(); ?></h2>
        <p><?php echo $this->model->getDescription(); ?></p>
    </div>
    
    <div id="stage">
        <h3>Tappe</h3>
        <a href="index.php?op=searchStays" >Cerca tappe</a>
    </div>

    <div id="stages">
    <?php
    if($tappe = $this->model->getBricks()){
        foreach($tappe as $tappa){ 
            if($tappa->getType() == STAY){
                echo "<div class='select_stages'>"
                    .  "<h2>".$tappa->getTemplate()->getName()."</h2>"
                    .  "<p>".$tappa->getTemplate()->getDescription()."</p>"
                    .  "<div><span><label>Prenotata dal </label>".$tappa->getStartDate()."</span><span><label>Al </label>".$tappa->getEndDate()."</div>"
                    .  "<div class='add_remove_to_stage'><a href='index.php?op=setOptionStay&id=".$tappa->getId()."' >Modifica tappa</a>"
                    .  "<a href='index.php?op=removeStay&id=".$tappa->getId()."' >Elimina tappa</a></div>"
                    ."</div>";
                echo "<a style='float:left;' href='index.php?op=searchTransport&from=".$tappa->getEndLocation()."' title='Scegli un trasporto per la tappa successiva'><img style='width:40%;' src='css/van.png'/></a>";
            }
            else {
                echo "<div class='transport'>";
                echo "<a href='index.php?op=openFormTransport&id=".$tappa->getId()."'>Modifica</a>";
                echo "</div>";
                echo "<a style='float:left; width:2em;' href='index.php?op=searchTransport&from=".$tappa->getEndLocation()."' title='Scegli un trasporto per la tappa successiva'><img style='width:40%;'src='css/van.png'/></a>";
            }
        }
    }
    ?>
    </div>
    
    <div  class="add_remove_to_stage" style="float:left;"><a href="index.php?op=saveItinerary" >Salva</a></div>
</div>