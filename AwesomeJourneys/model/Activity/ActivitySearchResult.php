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
    
    public function __sleep() {
        return array("aggregator", "iterator");
    }

    public function __wakeup() {
        
    }

    /*
     * DA MODIFICARE, CREARE UN'ALTRA FUNZIONE PRIVATA CHE RICERCA IN DB
     */
    public function search($query = NULL){
        $c = new Connection();
        
        if($query == NULL){
            $query = "SELECT activity.ID as ID, activity_template.ID as IDTemplate, * "
                   . "FROM activity INNER JOIN activity_template ON activity.template = activity_template.ID;";
        }
        
        if($c){
            $table = $c->execute_query($query);
            $c->close();
            if($table){
                foreach($table as $act){
                    $activity = new Activity($act->ID, $act->start_date, $act->stay_template, $act->end_date, $act->IDTemplate, $act->name, $act->address, $act->expected_duration, $act->location, $act->description);
                    $this->aggregator->add($activity);
                }
            }
        }
        
        $this->iterator = $this->aggregator->getIterator(); 
    }
    
    public function fetchObject() {
        if ($this->iterator->hasNext())
            return $this->iterator->next();
        else
            return NULL;
    }
    
    public function getObject($id){
        return $this->aggregator->getObject($id);
    }
}

?>
