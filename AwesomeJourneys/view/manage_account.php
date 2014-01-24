<?php $user = unserialize($_SESSION['utente']); ?>

<?php 
include_once 'partials/_login.php';
include_once 'partials/_personalmenu.php' 
?>

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