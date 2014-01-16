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

<?php 
    if(isset($user)){
        echo $user->getRole()." profile | <a href='index.php?op=logout'>Logout</a>";
    }
    else{
        echo "<a href='index.php?op=login'>Area clienti</a> | <a href='index.php?op=register'>Registrati</a>";
    }
?>
    
<?php include_once '_personalmenu.php' ?>

<div id='content'>
    <div class="tabs">
        <ul>
            <li><h4><a href="#itinerari">Itinerari</a></h4></li>
            <li><h4><a href="#viaggi">Viaggi</a></h4></li>
        </ul>
        <div id="itinerari">
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
        <div id="viaggi">
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
</div>