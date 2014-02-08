<?php $user = unserialize($_SESSION['utente']); ?>
<?php 
include_once 'partials/_login.php';
include_once 'partials/_personalmenu.php' 
?>

<div id="content">
    <?php
    $activity = $this->model['activity'];
    $idStay = $this->model['idStay'];
    ?>
    
    <h3><?php echo $activity->getName(); ?></h3>
    <p><?php echo $activity->getDescription(); ?></p>
    <div>
        <span><label>Disponibile dal: </label><?php echo $activity->getAvailableFrom(); ?></span>
        <span><label>Al: </label><?php echo $activity->getAvailableTo(); ?></span>
    </div>

    <form action="index.php" method="POST" onreset="window.location = 'index.php?op=manageItinerary&id='">
        <input type="hidden" type="number" name="idActivity" value="<?php echo $activity->getId(); ?>" />
        <input type="hidden" type="number" name="idStay" value="<?php echo $idStay; ?>" />
        <table>
            <tr>
                <td>Quando vuoi prenotare l'attivit&agrave;?</td>
                <td><input type='text' class="datepicker" name='date' value="<?php echo $activity->getDate(); ?>" required /></td>
            </tr>
            <tr>
                <td>Quante persone parteciperanno?</td>
                <td><input type='number' name='persons' value="<?php echo $activity->getPersons(); ?>" required /></td>
            </tr>
        </table>
        <button type='submit' name='op' value='modifyActivity' >Salva</button>
        <button type='reset' name='reset' value='reset'>Annulla</button>
    </form>
</div>