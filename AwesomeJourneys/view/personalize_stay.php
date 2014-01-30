<?php $user = unserialize($_SESSION['utente']); ?>
<?php 
include_once 'partials/_login.php';
include_once 'partials/_personalmenu.php' 
?>
<h2><?php echo $this->model->getTemplate()->getName(); ?></h2>
<p><?php echo $this->model->getTemplate()->getDescription(); ?></p>

<form action="index.php" method="GET">
    <b>Inserisci la data</b>
    <input type="hidden" name="idStay" value="<?php echo $this->model->getId(); ?>" />
    <table>
        <tr><td>Data inizio</td><td><input type="text" class="datepicker" name="startDate" required /></td></tr>
        <tr><td>Data fine</td><td><input type="text" class="datepicker" name="endDate" required /></td></tr>
    </table>
    <button type="submit" name="op" value="modifyStay">Salva</button>
</form>

<h3>Attività disponibili</h3>
<a href="index.php?op=searchActivities&idStay=<?php echo $this->model->getId(); ?>">Cerca altre attivit&agrave;</a>
<?php
$activities = $this->model->getTemplate()->getComponentsOfType(ACTIVITY);
foreach($activities as $activity){
    echo "<div class='stay'>"
         . "<h2>".$activity->getName()."</h2>"
         . "<p>".$activity->getDescription()."</p>"
         . "<div><span class='date'><label>Disponibile dal </label>".$activity->getAvailableFrom()."</span>"
         . "<span class='date'><label>al </label>".$activity->getAvailableTo()."</span></div>"
         . "<span class='see_more'><a href='index.php?op=selectActivity&id=".$activity->getId()."'>Vedi di pi&ugrave</a>"
         . "<a href='index.php?op=addActivity&id=".$activity->getId()."&idStay=".$this->model->getId()."'>Aggiungi alla tappa</a></span>"
         ."</div>";
}
?>

