<?php 
    if(isset($user)){
        echo $user->getRole()." profile | <a href='index.php?op=logout'>Logout</a>";
    }
    else{
        echo "<a href='index.php?op=login'>Area clienti</a> | <a href='index.php?op=register'>Registrati</a>";
    }
?>

<div id="s3slider">
    <ul id="s3sliderContent">
        <?php
            while($journey = $this->model->fetch_object()){
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

<h2>Le nostre offerte</h2>
