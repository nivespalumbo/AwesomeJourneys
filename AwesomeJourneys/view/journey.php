<?php $itinerary = $this->model->getItinerary(); ?>

<h3><?php echo $itinerary->getName(); ?></h3>
<img src="images/journeys/<?php echo $itinerary->getPhoto(); ?>" />
<p><?php echo $itinerary->getDescription(); ?></p>
<div>
    <span><label>Dal </label><?php echo $this->model->getStartDate(); ?></span>
    <span><label>Al </label><?php echo $this->model->getEndDate(); ?></span>
</div>
