<?php
include_once 'model/Actor/UserComponent.php';

if(!isset($_SESSION['utente']))
    header("Location:index.php?op=login");
else {
    $user = unserialize($_SESSION['utente']);
    /*if($user->getRole() == 'Customer')
        header("Location:index.php?op=errore&tipo=accesso");*/
}
?>

<html>
    <head>
        <title>Awesome Journeys</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style_layout.css" />
        <link rel="stylesheet" type="text/css" href="css/style_header.css" />
        <link rel="stylesheet" type="text/css" href="css/style_areariservata.css" />
        <link rel="stylesheet" type="text/css" href="css/style_searchresult.css" />
    </head>
    
    <body>
        <div id='container'>
            <?php include_once '_header.php'; ?>
            
            <div id='content'>
                <?php include_once '_personalmenu.php' ?>
                
                <div class="two-columns">
                    <div class="first-half">
                        <h2>Itinerari</h2>
                        <?php
                        include_once 'Oggetti/ItineraryInHTML.php';

                        if($this->model['itineraries'] != NULL){
                            while($itinerary = $this->model['itineraries']->fetch_object()){
                                $view = new ItineraryInHTML($itinerary);
                                $view->getItinerary();
                            }
                        }
                        else{
                            echo "<p>Nessun itinerario creato</p>";
                        }
                        ?>
                    </div>
                    <div class="second-half">
                        <h2>Viaggi</h2>
                        <?php
                        include_once 'Oggetti/JourneyInHTML.php';

                        if($this->model['journeys'] != NULL){
                            while($journey = $this->model['journeys']->fetch_object()){
                               $view = new JourneyInHTML($journey);
                               $view->get_journey();
                            }
                        }
                        else{
                            echo "<p>Nessun viaggio creato</p>";
                        }
                        ?>
                    </div>
                </div>
                <div class="cleaner"></div>
            </div>
            <div class="cleaner"></div>
        </div>
    </body>
</html>

