<?php 
    if(isset($user)){
        echo $user->getRole()." profile | <a href='index.php?op=logout'>Logout</a>";
    }
    else{
        echo "<a href='index.php?op=login'>Area clienti</a> | <a href='index.php?op=register'>Registrati</a>";
    }
?>

<h2>Registrazione</h2>
    <form action="index.php" method="POST" onreset="window.location='index.php';">
        <table>
            <tr><td>Name:</td><td><input type="text" name="name" required/></td></tr>
            <tr><td>Surname:</td><td><input type="text" name="surname" required/></td></tr>
            <tr><td>Address:</td><td><input type="text" name="address" required/></td></tr>
            <tr><td>Telephone:</td><td><input type="text" name="telephone" required/></td></tr>
            <tr><td>E-mail:</td><td><input type="text" name="mail" required/></td></tr>
            <tr><td>Password</td><td><input type="password" name="pass" required/></td></tr>
            <tr><td>Ripeti password</td><td><input type="password" name="passBis" required/></td></tr>
        </table>
        <p>
            <button type="submit" name="op" value="register">Registrati</button>
            <button type="reset" name="annulla">Annulla</button>
        </p>
    </form>