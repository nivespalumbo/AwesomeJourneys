<div id="stay_list">
<?php
include_once 'model/StayTemplate/StayTemplateComponent.php';
include_once 'model/StayTemplate/StaySearchResult.php';

while($stay = $this->model->fetchObject()){
    echo "<div class='stay'>"
         . "<h2>".$stay->getName()."</h2>"
         . "<p>".$stay->getDescription()."</p>"
         . "<div><span><label>Start date:</label>".$stay->getStartDate()."</span>"
         . "<span><label>End date:</label>".$stay->getEndDate()."</span></div>"
         . "<a href='index.php?op=selectStay'>Vedi di più</a>";
}
?>
</div>