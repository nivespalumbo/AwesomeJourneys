<div id="menu_personale">
    <ul  class="menu">
        <li><a href='#'><?php echo $user->getName() ?></a>
            <ul>
                <li><a href="index.php?op=getPersonalData">Account</a></li>
                <li><a href="#">Impostazioni privacy</a></li>
            </ul>
        </li>
        <li><a href='#'>Viaggi</a>
            <ul>
                <li><a href="index.php?op=myItinerariesOrJourneys">I miei viaggi</a></li>
                <li><a href="index.php?op=openNewItinerary">Crea un nuovo itinerario</a></li>
                <li><a href="#">Prenota un viaggio</a></li>
            </ul>
        </li>
        <li><a href='index.php?op=openSearch'>Cerca</a></li>
    </ul>    
</div>