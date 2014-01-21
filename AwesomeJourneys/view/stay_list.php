<div id="stay_list">
<?php
include_once 'model/StayTemplate/StayTemplateComponent.php';
include_once 'model/StayTemplate/StaySearchResult.php';

while($stay = $this->model->fetchObject()){
    echo "<div class='stay'>"
         . "<h2>".$stay->getName()."</h2>"
         . "<p>".$stay->getDescription()."</p>"
         . "<div><span class='date'><label>Start date:</label>".$stay->getStartDate()."</span>"
         . "<span class='date'><label>End date:</label>".$stay->getEndDate()."</span></div>"
         . "<span class='see_more'><a href='index.php?op=selectStay&id=".$stay->getId()."'>Vedi di pi&ugrave</a></span>"
         ."</div>";
}
?>
</div>