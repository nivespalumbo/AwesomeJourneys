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
    $tappe = $this->model->getBricks();
    foreach($tappe as $tappa){ 
        echo "<div id='select_stages'>"
            .  "<label>".$tappa->getTemplate()->getName()."</label>"
            .  "<p>".$tappa->getTemplate()->getDescription()."</p>"
            .  "<div class='add_remove_to_stage'><a href='index.php?op=modifyStay&id=".$tappa->getId()."' >Modifica tappa</a></div>"
            .  "<div class='add_remove_to_stage'><a href='index.php?op=removeStay&id=".$tappa->getId()."' >Elimina tappa</a></div>"
            ."</div>";
    }
    ?>
    </div>
</div>