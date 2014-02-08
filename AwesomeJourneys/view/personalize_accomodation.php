<?php $user = unserialize($_SESSION['utente']); ?>
<?php 
include_once 'partials/_login.php';
include_once 'partials/_personalmenu.php' 
?>

<?php 
$accomodation = $this->model['accomodation'];
$idStay = $this->model['idStay'];
?>

<div id="content">
    <h3><?php echo $accomodation->getName(); ?></h3>
    <p><?php echo $accomodation->getDescription(); ?></p>
    <div>
        <span><label></label><?php  ?></span>
        <span><label></label><?php  ?></span>
    </div>

    <form action="index.php" method="POST" onreset="window.location = 'index.php?op=manageItinerary&id='">
        <input type="hidden" type="number" name="idStay" value="<?php echo $idStay; ?>" />
        <table>
            <tr>
                <td>Quando vuoi prenotare il pernottamento?</td>
                <td><input type='text' class="datepicker" name='date' value="<?php echo $accomodation->getStartDate(); ?>" required /></td>
            </tr>
            <tr>
                <td>Per quanti giorni?</td>
                <td><input type='number' name='duration' value="<?php echo $accomodation->getDuration(); ?>" required /></td>
            </tr>
        </table>
        <button type='submit' name='op' value='modifyAccomodation' >Salva</button>
        <button type='reset' name='reset' value='reset'>Annulla</button>
    </form>
</div>