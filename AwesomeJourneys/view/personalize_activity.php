<?php $user = unserialize($_SESSION['utente']); ?>
<?php 
include_once 'partials/_login.php';
include_once 'partials/_personalmenu.php' 
?>

<div id="content">
    <h3><?php echo $this->model->getName(); ?></h3>
    <p><?php echo $this->model->getDescription(); ?></p>
    <div>
        <span><label>Disponibile dal: </label><?php echo $this->model->getAvailableFrom(); ?></span>
        <span><label>Al: </label><?php echo $this->model-> getAvailableTo(); ?></span>
    </div>

    <form action="index.php" method="POST" onreset="window.location = 'index.php?op=manageItinerary&id='">
        <table>
            <tr>
                <td>Quando vuoi prenotare l'attività?</td><td><input type='text' class="datepicker" name='startDate' required /></td>
                <td>Quante persone parteciperanno?</td><td><input type='number' name='persons' required /></td>
            </tr>
        </table>
        <button type='submit' name='op' value='setOptionActivity' >Salva</button>
        <button type='reset' name='reset' value='reset'>Annulla</button>
    </form>
</div>