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
        <script type="text/javascript" src="scripts/lib/jquery/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="scripts/lib/jqueryui/jquery-ui-1.10.3.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="css/themes/start/jquery-ui-1.10.3.css" />
    </head>
    
    <body>
        <div id='container'>
            <?php include_once '_header.php' ?>
            
            <div id='content'>
                <?php include_once '_personalmenu.php' ?>
                
                <div>
                    
                </div>
                <div class="cleaner"></div>
            </div>
            <?php include_once '_footer.php';?>
        </div>
    </body>
</html>
