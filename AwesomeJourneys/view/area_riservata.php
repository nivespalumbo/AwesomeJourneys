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

<?php include_once '_personalmenu.php'; ?>

<div>
    <p>Contenuto prima pagina dell'area riservata</p>
</div>


