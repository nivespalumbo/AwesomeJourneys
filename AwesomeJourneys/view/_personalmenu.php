<div id="menu_personale" class="accordion">
    <h3><?php echo $user->getName() ?></h3>
    <div>
        <a href="<?php echo $_SERVER['PHP_SELF']."?op=personalData"?>">Account</a>
    </div>
    <h3>Viaggi</h3>
    <div>
        <ul>
            <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=myItiner"?>">I miei viaggi</a></li>
            <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=newItiner"?>">Crea un nuovo itinerario</a></li>
            <li><a href="#">Prenota un viaggio</a></li>
        </ul>
    </div>
    <h3>Cerca</h3>
    <div>
        <ul>
            <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=searchItiner"?>">Cerca itinerari</a></li>
            <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=searchJourney"?>">Cerca viaggi</a></li>
        </ul>
    </div>
<!--    <ul>
        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=personalData"?>"><?php echo $user->getName() ?></a></li>
        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=myItiner"?>">I miei viaggi</a></li>
        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=newItiner"?>">Nuovo itinerario</a></li>
        <li><a href="<?php echo $_SERVER['PHP_SELF']."?op=searchItiner"?>">Cerca</a></li>
    </ul>-->
</div>

<script type="text/javascript">
    $(".accordion").accordion();
</script>
