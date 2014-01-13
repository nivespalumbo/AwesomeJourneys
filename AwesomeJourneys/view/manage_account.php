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

<html>
    <head>
        <title>Awesome Journeys</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style_layout.css" />
        <link rel="stylesheet" type="text/css" href="css/style_header.css" />
        <link rel="stylesheet" type="text/css" href="css/style_areariservata.css" />
    </head>
    
    <body>
        <div id='container'>
            <header>
                <div>
                    <img src="images/baloon.png" alt="baloon">
                </div>
                <div>
                    <h1><a href="index.php">Awesome Journeys</a></h1>
                    <p style='float:right; color: #A8A8A8; font-size: 12px;'>
                        <?php echo $user->getRole()." profile"; ?> | <a href="<?php echo $_SERVER['PHP_SELF']."?op=logout"; ?>" style='color: #A8A8A8'>Logout</a>
                    </p>
                </div>
                <div id='menu'>
                    <ul>
                        <li><a href="#">Last minute</a></li>
                        <li><a href="#">All-inclusive</a></li>
                        <li><a href="#">Pacchetti vacanze</a></li>
                        <li><a href="#">Crociere</a></li>
                    </ul>
                </div>
                <div class="cleaner"></div>
            </header>
            
            <div id='content'>
                <div id="menu_personale">
                    <ul>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=personalData"?>"><?php echo $user->getName() ?></a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=itiner"?>">I miei viaggi</a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=newItiner"?>">Nuovo itinerario</a></li>
                    </ul>
                </div>
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
                <div class="cleaner"></div>
            </div>
            <div class="cleaner"></div>
        </div>
    </body>
</html>
