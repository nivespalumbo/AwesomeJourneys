<div id="stay_list">
<?php
include_once 'model/StayTemplate/StayTemplateComponent.php';
include_once 'model/StayTemplate/StaySearchResult.php';

while($transport = $this->model->fetchObject()){
    echo "<div class='stay'>"
         . "<h2>".$transport->getName()."</h2>"
         . "<p>".$transport->getDescription()."</p>"
         . "<span class='see_more'><a href='index.php?op=selectStay&id=".$transport->getId()."'>Vedi di pi&ugrave</a>"
         . "<a href='index.php?op=addStay&id=".$transport->getId()."'>Aggiungi all'itinerario</a></span>"
         ."</div>";
}
?>
</div>