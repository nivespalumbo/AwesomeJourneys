<?php $user = unserialize($_SESSION['utente']); ?>
<?php 
include_once 'partials/_login.php';
include_once 'partials/_personalmenu.php' 
?>
<div id="content">

    <h2><?php echo $this->model->getTemplate()->getName(); ?></h2>
    <p><?php echo $this->model->getTemplate()->getDescription(); ?></p>

    <form action="index.php" method="POST">
        <fieldset>
            <legend>Inserisci le date</legend>
            <input type="hidden" name="idStay" value="<?php echo $this->model->getId(); ?>" />
            <table>
                <tr><td>Data inizio</td><td><input type="text" class="datepicker" name="startDate" value="<?php echo $this->model->getStartDate(); ?>" required /></td></tr>
                <tr><td>Data fine</td><td><input type="text" class="datepicker" name="endDate" value="<?php echo $this->model->getEndDate(); ?>" required /></td></tr>
            </table>
        </fieldset>
        <button type="submit" name="op" value="modifyStay">Salva</button>
    </form>

    <div class="title"><h3>Attivita' disponibili</h3></div>
    <div class="add_remove_to_stage"><a href="index.php?op=searchActivities&idStay=<?php echo $this->model->getId(); ?>">Cerca altre attivit&agrave;</a></div>
    <?php
    $activities = $this->model->getTemplate()->getComponentsOfType(ACTIVITY);
    foreach($activities as $activity){
        echo "<div class='stay'>"
             . "<h2>".$activity->getName()."</h2>"
             . "<p>".$activity->getDescription()."</p>"
             . "<div><span class='date'><label>Disponibile dal </label>".$activity->getAvailableFrom()."</span>"
             . "<span class='date'><label>al </label>".$activity->getAvailableTo()."</span></div>"
             . "<span class='see_more'><a href='index.php?op=selectActivity&id=".$activity->getId()."&idStay=".$this->model->getId()."'>Vedi di pi&ugrave</a>"
             . "<a href='index.php?op=addActivity&id=".$activity->getId()."&idStay=".$this->model->getId()."'>Aggiungi alla tappa</a></span>"
             . "</div>";
    }
    ?>

    <div class="title"><h3>Attivita' prenotate</h3></div>
    <?php
    $selected = $this->model->getSelectedActivities();
    foreach($selected as $activity){
        echo "<div class='stay'>"
             . "<h2>".$activity->getName()."</h2>"
             . "<p>".$activity->getDescription()."</p>"
             . "<div><span class='date'><label>Prenotata il </label>".$activity->getDate()."</span>"
             . "<span class='date'><label>Per </label>".$activity->getPersons()."</span></div>"
             . "<span class='see_more'><a href='index.php?op=setOptionActivity&idActivity=".$activity->getId()."&idStay=".$this->model->getId()."'>Modifica attivit&agrave</a>"
             . "<a href='index.php?op=removeActivity&idActivity=".$activity->getId()."&idStay=".$this->model->getId()."'>Elimina attivit&agrave</a></span>"
             . "</div>";
    }
    ?>

    <div class="title"><h3>Scegli un pernottamento</h3></div>
    <?php
    $accomodations = $this->model->getTemplate()->getComponentsOfType(ACCOMODATION);
    $selected = $this->model->getSelectedAccomodation();
    foreach($accomodations as $acc){
        echo "<div class='stay'>"
            . "<h2>".$acc->getName()."</h2>"
            . "<p>".$acc->getDescription()."</p>";
        if($selected != NULL && $acc->getId() == $selected->getId()){
            echo "<span class='see_more'><a href='index.php?op=setOptionAccomodation&id=".$this->model->getId()."'>Modifica pernottamento</a>"
               . "<a href='index.php?op=removeAccomodation&id=".$this->model->getId()."'>Elimina pernottamento</a></span>";
        }
        else {
            echo "<span class='see_more'><a href='index.php?op=selectAccomodation&idAccomodation=".$acc->getId()."&idStay=".$this->model->getId()."'>Dimmi di pi&ugrave</a>"
               . "<a href='index.php?op=addAccomodation&id=".$acc->getId()."&idStay=".$this->model->getId()."'>Scegli questo pernottamento</a></span>";
        }
        echo "</div>";
    }
    ?>
</div>

