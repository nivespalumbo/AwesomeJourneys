<?php $user = unserialize($_SESSION['utente']); ?>

<?php 
include_once '_login.php';
include_once '_personalmenu.php' 
?>
                
<div> 
    <form action="index.php" method="POST">
    <table>
        <tr><td>Nome:</td><td><input type="text" name="name" required/></td></tr>
        <tr><td>Descrizione:</td><td><input type="text" name="description" required/></td></tr>
    </table>
    <p><button type="submit" name="op" value="basicInfoItinerary">Crea</button><button type="reset" name="annulla">Annulla</button></p>
    </form>
</div>
                