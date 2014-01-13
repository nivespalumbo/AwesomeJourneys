<html>
    <head>
        <title>Awesome Journeys</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style_layout.css" />
        <link rel="stylesheet" type="text/css" href="css/style_header.css" />
        <link rel="stylesheet" type="text/css" href="css/style_searchresult.css" />
    </head>
    
    <body>
        <div id='container'>
            <div id='header'>
                <img src="images/baloon.png" alt="baloon">
                <h1><a href="index.php">Awesome Journeys</a></h1>
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
            </div>
        </div>
    </body>
</html>
