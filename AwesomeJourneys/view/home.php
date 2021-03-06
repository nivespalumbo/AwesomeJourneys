<?php include_once 'partials/_login.php'; ?>

<div id="s3slider">
    <ul id="s3sliderContent">
        <?php
            while($journey = $this->model->fetchObject()){
                $itinerary = $journey->getItinerary();
                echo "<li class='s3sliderImage'>
                        <img src='images/journeys/".$itinerary->getPhoto()."'>
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

<div id="our_journeys"><h2>I nostri viaggi</h2></div>
<?php
while($journey = $this->model->fetchObject()){
    $itinerary = $journey->getItinerary();
    echo "<div class='viaggio grid'>
            <img src='images/journeys/".$itinerary->getPhoto()."'>
            <span>
                <h3><a href='index.php?op=selectJourney&id=".$journey->getId()."' >".$itinerary->getName()."</a></h3>
                <p>".$itinerary->getDescription()."</p>
            </span>
          </div>";
}
?>
<div id="search_link"><a href="index.php?op=openSearch" >Cerca</a></div>
