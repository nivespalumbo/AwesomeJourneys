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
            <header>
                <div>
                    <img src="images/baloon.png" alt="baloon">
                </div>
                <div>
                    <h1><a href="index.php">Awesome Journeys</a></h1>
                    <p style='float:right; color: #A8A8A8; font-size: 12px;'>
                        <a href="index.php?op=login" style='color: #A8A8A8;'>Area clienti</a> | <a href="index.php?op=register" style='color: #A8A8A8'>Registrati</a>
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
            <div class="cleaner"></div>
        </div>
    </body>
</html>
