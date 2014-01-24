<?php $user = unserialize($_SESSION['utente']); ?>

<?php 
include_once 'partials/_login.php';
include_once 'partials/_personalmenu.php' 
?>
                
<div> 
    <form action="index.php" method="GET">
    <table>
        <tr><td>Nome:</td><td><input type="text" name="name" required/></td></tr>
        <tr><td>Descrizione:</td><td><input type="text" name="description" required/></td></tr>
    </table>
    <p><button type="submit" name="op" value="provideBasicInfo">Crea</button><button type="reset" name="annulla">Annulla</button></p>
    </form>
</div>
                