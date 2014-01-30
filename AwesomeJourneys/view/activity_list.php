<div id="stay_list">
<?php
include_once 'model/Activity/Activity.php';
include_once 'model/Activity/ActivitySearchResult.php';

$idStay = $this->model['stay'];

while($activity = $this->model['activities']->fetchObject()){
    echo "<div class='stay'>"
         . "<h2>".$activity->getName()."</h2>"
         . "<p>".$activity->getDescription()."</p>"
         . "<div><span class='date'><label>Disponibile dal </label>".$activity->getAvailableFrom()."</span>"
         . "<span class='date'><label>al </label>".$activity->getAvailableTo()."</span></div>"
         . "<span class='see_more'><a href='index.php?op=selectActivity&id=".$activity->getId()."'>Vedi di pi&ugrave</a>"
         . "<a href='index.php?op=addActivityFromTemplate&id=".$activity->getId()."&idStay=$idStay'>Aggiungi alla tappa</a></span>"
         ."</div>";
}
?>
</div>