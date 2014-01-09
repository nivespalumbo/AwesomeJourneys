<?php
include_once 'Controller/ManagementController.php';

$user = new ManagementController();
if(isset($_POST['op'])){
   switch ($_POST['op']){
      case "login" :
         $user->login($_POST['mail'], sha1($_POST['pass']));
         break;
      case "register" :
         $user->register($_POST['name'], $_POST['surname'], $_POST['address'], $_POST['telephone'], $_POST['mail'], sha1($_POST['pass']));
         break;
    }
} else {
    if(!isset($_SESSION['login']))
        header("Location:index.php?op=login");
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
                    <?php echo $user->printRole()." profile"; ?> | <a href="<?php echo $_SERVER['PHP_SELF']."?op=logout"; ?>" style='color: #A8A8A8'>Logout</a>
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
                    <p><?php echo "Benvenuto/a,<br/>".$user->printNome()."!"; ?></p>
                    <ul>
                        <li><a href="#">I miei dati</a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=itiner"?>">I miei viaggi</a></li>
                    </ul>
                </div>
                <div id="context">
                <?php
                if(isset($_GET['op'])){
                    switch ($_GET['op']) {
                        case "logout":
                            $user->logout();
                            header("Location:index.php");
                            break;
                        case "itiner" :
                            $user->getMyItineraries();
                            break;
                        default:
                            break;
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </body>
</html>
