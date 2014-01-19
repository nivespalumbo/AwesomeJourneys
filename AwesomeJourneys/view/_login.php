<?php 
    if(isset($user)){
        echo "<div id='div_login'><p>".$user->getRole()." profile | <a href='index.php?op=logout'>Logout</a></p></div>";
    }
    else{
        echo "<div id='div_login'><p><a href='index.php?op=login'>Area clienti</a> | <a href='index.php?op=register'>Registrati</a></p></div>";
    }
?>