<h2>Login</h2>
<form action="index.php" method="POST" onreset="window.location='index.php';">
    <table>
        <tr><td>E-mail:</td><td><input type="text" name="mail" required/></td></tr>
        <tr><td>Password</td><td><input type="password" name="pass" required/></td></tr>
    </table>
    <p>
        <button type="submit" name="op" value="login">Login</button>
        <button type="reset" name="annulla">Annulla</button>
    </p>
</form>