<?php 
    if(isset($user)){
        echo "<div id='div_login'>".$user->getRole()." profile | <a href='index.php?op=logout'>Logout</a></div>";
    }
    else{
        echo "<div id='div_login'><a href='index.php?op=login'>Area clienti</a> | <a href='index.php?op=register'>Registrati</a></div>";
    }
?>