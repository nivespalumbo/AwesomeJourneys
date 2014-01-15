<header>
    <div>
        <img src="images/baloon.png" alt="baloon" style="max-height: 80px; max-width: 80px;">
    </div>
    <div>
        <h1><a href="index.php">Awesome Journeys</a></h1>
        <p style='float:right; color: #A8A8A8; font-size: 12px;'>
            <?php 
            if(isset($user)){
                echo $user->getRole()." profile | <a href='".$_SERVER['PHP_SELF']."?op=logout' style='color: #A8A8A8'>Logout</a>";
            }
            else{
                echo "<a href='index.php?op=login' style='color: #A8A8A8;'>Area clienti</a> | <a href='index.php?op=register' style='color: #A8A8A8'>Registrati</a>";
            }
            ?>
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