<?php
//include_once 'Oggetti/ItineraryInHTML.php';
//
//$view = new ItineraryInHTML($this->model);
//$view->getItinerary();

?>

<h2><?php echo $this->model->getName(); ?></h2>
<p><?php echo $this->model->getDescription(); ?></p>

<h3>Tappe</h3>
<a href="index.php?op=searchStay" >Search stay</a>
<?php

?>