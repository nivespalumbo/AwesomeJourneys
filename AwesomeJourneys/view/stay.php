<h2><?php echo $this->model->getName() ?></h2>
<p><?php echo $this->model->getDescription() ?></p>
<!--<div>
    <span><label>Disponibile dal </label><?php //echo $this->model->getAvailableFrom();?></span>
    <span><label>Al</label><?php //echo $this->model->getAvailableTo(); ?></span>
</div>-->
<div>
    <h3>Attività disponibili</h3>
    <ul>
        <?php
        $activities = $this->model->getComponentsOfType(ACTIVITY);
        foreach($activities as $a){
            echo "<li>"
                 .  "<b>".$a->getName()."</b>"
                 .  "<p>".$a->getDescription()."</p>"
                 .  "<a href='index.php?op=selectActivity&id=".$a->getId()."&idStay=".$this->model->getId()."'>Dimmi di pi&ugrave</a>"
                 ."</li>";
        }
        ?>
    </ul>
</div>
<div>
    <h3>Pernottamenti disponibili</h3>
    <ul>
        <?php
        $accomodations = $this->model->getComponentsOfType(ACCOMODATION);
        foreach($accomodations as $a){
            echo "<li>"
                 . "<h4>".$a->getName()."</h4>"
                 . "<p>".$a->getDescription()."</p>"
                 . "<div><span>Tipo: ".$a->getAccomodationType()."</span>"
                 . "<span>Location: ".$a->getLocation()."</span></div>"
                 . "<a href='index.php?op=selectAccomodation&idStay=".$this->model->getId()."&idAccomodation=".$a->getId()."'>Dimmi di più</a>"
                 . "</li>";
        }
        ?>
    </ul>
</div>