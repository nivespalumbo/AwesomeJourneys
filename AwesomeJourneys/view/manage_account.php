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

<?php 
    if(isset($user)){
        echo $user->getRole()." profile | <a href='index.php?op=logout'>Logout</a>";
    }
    else{
        echo "<a href='index.php?op=login'>Area clienti</a> | <a href='index.php?op=register'>Registrati</a>";
    }
?>

<?php include_once '_personalmenu.php' ?>

<div>
    <h2>I miei dati</h2>
    <table>
        <tr><td><b>Nome</b></td><td><?php echo $user->getName() ?></td></tr>
        <tr><td><b>Cognome</b></td><td><?php echo $user->getSurname() ?></td></tr>
        <tr><td><b>Indirizzo</b></td><td><?php echo $user->getAddress() ?></td></tr>
        <tr><td><b>Telefono</b></td><td><?php echo $user->getTelephone() ?></td></tr>
        <tr><td><b>E-mail</b></td><td><?php echo $user->getMail() ?></td></tr>
    </table>
    <button type="button">Cambia</button>
</div>