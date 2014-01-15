<?php
include_once 'model/Actor/UserComponent.php';

if(!isset($_SESSION['utente']))
    header("Location:index.php?op=login");
else {
    $user = unserialize($_SESSION['utente']);
    /*if($user->getRole() == 'Customer')
        header("Location:index.php?op=errore&tipo=accesso");*/
}
?>
                <?php include_once '_personalmenu.php' ?>
                
                <div> 
                    <form action="index.php" method="POST">
                    <table>
                        <tr><td>Nome:</td><td><input type="text" name="name" required/></td></tr>
                        <tr><td>Descrizione:</td><td><input type="text" name="description" required/></td></tr>
                    </table>
                    <p><button type="submit" name="op" value="newItiner">Crea</button><button type="reset" name="annulla">Annulla</button></p>
                    </form>
                </div>
                