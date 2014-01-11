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
            <div id='header'>
                <img src="images/baloon.png" alt="baloon">
                <h1><a href="index.php">Awesome Journeys</a></h1>
                <p style='float:right; color: #A8A8A8; font-size: 12px;'>
                    <?php echo $user->getRole()." profile"; ?> | <a href="<?php echo $_SERVER['PHP_SELF']."?op=logout"; ?>" style='color: #A8A8A8'>Logout</a>
                </p>
                <div id='menu'>
                    <ul>
                        <li><a href="#">Last minute</a></li>
                        <li><a href="#">All-inclusive</a></li>
                        <li><a href="#">Pacchetti vacanze</a></li>
                        <li><a href="#">Crociere</a></li>
                    </ul>
                </div>
            </div>
            <div id='content'>
                <div id="menu_personale">
                    <ul>
                        <li><a href="#">I miei dati</a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=itiner"?>">I miei viaggi</a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=newItiner"?>">I miei viaggi</a></li>
                    </ul>
                </div>
                <div> 
                    <form action="index.php" method="POST">
                    <table>
                        <tr><td>Nome:</td><td><input type="text" name="name" required/></td></tr>
                        <tr><td>Descrizione:</td><td><input type="text" name="description" required/></td></tr>
                    </table>
                    <p><button type="submit" name="op" value="newItiner">Login</button><button type="reset" name="annulla">Annulla</button></p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

