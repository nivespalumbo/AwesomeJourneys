<?php
include_once 'ActivityConcreteAggregator.php';
include_once 'ActivityIterator.php';
include_once 'Activity.php';
/**
 * Description of ActivitySearchResult
 *
 * @author anto
 */
class ActivitySearchResult {
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new ActivityConcreteAggregator();
    }
    
    /*
     * DA MODIFICARE, CREARE UN'ALTRA FUNZIONE PRIVATA CHE RICERCA IN DB
     */
    public function search(){
        $c = new Connection();
        
        $query = "SELECT activity.ID as ID, activity_template.ID as IDTemplate, * "
               . "FROM activity INNER JOIN activity_template ON activity.template = activity_template.ID;";
        
        if($c){
            $table = $c->fetch_query($query);
            $c->close();
            if($table){
                $numRows = count($table,COUNT_NORMAL);
                for($i=0; $i<$numRows; $i++){
                    $this->aggregator->add(new Activity($table[$i]->ID, $table[$i]->start_date, $table[$i]->stay_template, $table[$i]->end_date, $table[$i]->IDTemplate, $table[$i]->name, $table[$i]->address, $table[$i]->expected_duration, $table[$i]->location, $table[$i]->description));
                }
            }
        }
        
        $this->iterator = $this->aggregator->createIterator(); 
    }
    
    public function fetch_object() {
        if ($this->iterator->hasNext())
            return $this->iterator->next();
        else
            return NULL;
    }
}

?>
