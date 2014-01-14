<!DOCTYPE html>
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
            <?php include_once '_header.php' ?>;
        
            <div id='content'>
                <h2>Le nostre offerte</h2>
                <?php
                    include_once 'Oggetti/JourneyInHTML.php';

                    while($journey = $this->model->fetch_object()){
                       $view = new JourneyInHTML($journey);
                       $view->get_journey();
                    }
                ?>
            </div>
            <div class="cleaner"></div>    
        </div>
    </body>
</html>
