<div id="menu_personale">
    <ul  class="menu">
        <li><a href='#'><?php echo $user->getName() ?></a>
            <ul>
                <li><a href="index.php?op=getPersonalData">Account</a></li>
                <?php if($user->getRole() == "Customer") echo "<li><a href='#'>Impostazioni privacy</a></li>"; ?>
            </ul>
        </li>
        <li><a href='#'>Viaggi</a>
            <ul>
                <li><a href="index.php?op=myItinerariesOrJourneys">I miei viaggi</a></li>
                <li><a href="index.php?op=openNewItinerary">Crea un nuovo itinerario</a></li>
                <?php if($user->getRole() == "Customer") echo "<li><a href='#'>Prenota un viaggio</a></li>"; ?>
                
                <?php
                if($user->getRole() == "Travel Agent"){
                    echo "<li><a href='#'>Crea template</a>"
                        . "<ul>"
                            . "<li><a href='#'>Activity</a></li>"
                            . "<li><a href='#'>Accomodation</a></li>"
                            . "<li><a href='#'>Transport</a></li>"
                        . "</ul>"
                       . "</li>";
                    echo "<li><a href='#'>Gestisci stay</a>"
                        . "<ul>"
                            . "<li><a href='#'>Crea nuovo</a></li>"
                            . "<li><a href='#'>Modifica esistente</a></li>"
                        . "</ul>"
                       . "</li>";
                }
                ?>
            </ul>
        </li>
        <li><a href='index.php?op=openSearch'>Cerca</a></li>
    </ul>    
</div>
