<div id="stay_list">
<?php
include_once 'model/StayTemplate/StayTemplateComponent.php';
include_once 'model/StayTemplate/StaySearchResult.php';

while($stay = $this->model->fetchObject()){
    echo "<div class='stay'>"
         . "<h2>".$stay->getName()."</h2>"
         . "<p>".$stay->getDescription()."</p>"
         . "<span class='see_more'><a href='index.php?op=selectStay&id=".$stay->getId()."'>Vedi di pi&ugrave</a>"
         . "<a href='index.php?op=addStay&id=".$stay->getId()."'>Aggiungi all'itinerario</a></span>"
         ."</div>";
}
?>
</div>