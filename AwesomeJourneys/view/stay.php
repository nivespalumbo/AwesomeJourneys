<h2><?php echo $this->model->getName() ?></h2>
<p><?php echo $this->model->getDescription() ?></p>
<!--<div>
    <span><label>Disponibile dal </label><?php /*echo $this->model->getAvailableFrom();*/ ?></span>
    <span><label>Al</label><?php /*echo $this->model->getAvailableTo();*/ ?></span>
</div>-->
<div class="stay">
    <div class="title"><h3>Attivit&agrave; disponibili</h3></div>
    <ul style="margin-top:2%; margin-bottom:2%;">
        <?php
        $activities = $this->model->getComponentsOfType(ACTIVITY);
        foreach($activities as $a){
            echo "<li>"
                 .  "<h3>".$a->getName()."</h3>"
                 .  "<p>".$a->getDescription()."</p>"
                 .  "<div class='add_remove_to_stage'><a href='index.php?op=selectActivity&id=".$a->getId()."&idStay=".$this->model->getId()."'>Dimmi di pi&ugrave</a></div>"
                 ."</li>";
        }
        ?>
    </ul>
</div>
<div class="stay">
    <div class="title"><h3>Pernottamenti disponibili</h3></div>
    <ul style="margin-top:2%; margin-bottom:2%;">
        <?php
        $accomodations = $this->model->getComponentsOfType(ACCOMODATION);
        foreach($accomodations as $a){
            echo "<li>"
                 . "<h3>".$a->getName()."</h3>"
                 . "<p>".$a->getDescription()."</p>"
                 . "<div><span>Tipo: ".$a->getAccomodationType()."</span>"
                 . "<span>Location: ".$a->getLocation()."</span></div>"
                 . "<div class='add_remove_to_stay'><a href='index.php?op=selectAccomodation&idStay=".$this->model->getId()."&idAccomodation=".$a->getId()."'>Dimmi di pi&ugrave</a></div>"
                 . "</li>";
        }
        ?>
    </ul>
</div>