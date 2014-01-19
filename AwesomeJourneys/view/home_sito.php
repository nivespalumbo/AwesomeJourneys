<?php include_once '_login.php'; ?>

<div id="s3slider">
    <ul id="s3sliderContent">
        <?php
            while($journey = $this->model->fetchObject()){
                $itinerary = $journey->getItinerary();
                echo "<li class='s3sliderImage'>
                        <img src='journeys/".$itinerary->getPhoto()."'>
                        <span>
                          <h3>".$itinerary->getName()."</h3>
                          <p>".$itinerary->getDescription()."</p>
                        </span>
                      </li>";
            }
        ?>
        <div class="clear s3sliderImage"></div>
    </ul>
</div>

<h2>I nostri viaggi</h2>
<?php
$this->model->replay();
while($journey = $this->model->fetchObject()){
    $itinerary = $journey->getItinerary();
    echo "<div class='viaggio grid'>
            <img src='journeys/".$itinerary->getPhoto()."'>
            <span>
                <h3>".$itinerary->getName()."</h3>
                <p>".$itinerary->getDescription()."</p>
            </span>
          </div>";
}
?>
