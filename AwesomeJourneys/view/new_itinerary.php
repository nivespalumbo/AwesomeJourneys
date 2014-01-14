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
            <?php include_once '_header.php' ?>
            
            <div id='content'>
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
                <div class="cleaner"></div>
            </div>
        </div>
    </body>
</html>

