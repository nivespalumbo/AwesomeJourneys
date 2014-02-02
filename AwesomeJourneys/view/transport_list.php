<div id="stay_list">
<?php
include_once 'model/StayTemplate/StayTemplateComponent.php';
include_once 'model/StayTemplate/StaySearchResult.php';

while($transport = $this->model->fetchObject()){
    echo "<div class='stay'>"
         . "<h2>".$transport->getName()."</h2>"
         . "<p>".$transport->getDescription()."</p>"
         . "<p>".$transport->getVehicle()."</p>"
         . "<div><span>Da ".$transport->getStartLocation()." </span><span>A ".$transport->getEndLocation()."</span></div>"
         . "<div><span>Il ".$transport->getStartDate()." </span><span>Durata: ".$transport->getDuration()."</span></div>"
         . "<a href='index.php?op=addTransport&id=".$transport->getId()."'>Aggiungi all'itinerario</a></span>"
         ."</div>";
}
?>
</div>