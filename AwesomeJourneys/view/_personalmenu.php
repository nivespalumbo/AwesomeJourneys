<div id="menu_personale">
    <ul>
        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=personalData"?>"><?php echo $user->getName() ?></a></li>
        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=myItiner"?>">I miei viaggi</a></li>
        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=newItiner"?>">Nuovo itinerario</a></li>
        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=searchItiner"?>">Cerca</a></li>
    </ul>
</div>
