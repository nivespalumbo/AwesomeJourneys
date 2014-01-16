<?php 
    if(isset($user)){
        echo $user->getRole()." profile | <a href='index.php?op=logout'>Logout</a>";
    }
    else{
        echo "<a href='index.php?op=login'>Area clienti</a> | <a href='index.php?op=register'>Registrati</a>";
    }
?>

<form action="index.php" method="GET">
    <label>Luogo</label><input type="text" name="location" />
    <label>Data partenza</label><input type="date" name="startDate" class="datepicker"/>
    <button type="submit" name="op" value="search">Cerca</button>
</form>