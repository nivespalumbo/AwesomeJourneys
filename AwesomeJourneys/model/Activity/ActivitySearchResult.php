<?php
include_once 'model/AJConcreteAggregator.php';
include_once 'ActivityTemplate.php';
/**
 * Description of ActivitySearchResult
 *
 * @author anto
 */
class ActivitySearchResult {
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new AJConcreteAggregator();
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
            $query = "SELECT * "
                   . "FROM activity_template;";
        }
        
        if($c){
            $table = $c->execute_query($query);
            $c->close();
            if($table){
                foreach($table as $row){
                    $activity = new ActivityTemplate($row->ID, $row->name, $row->address, $row->expected_duration, $row->location, $row->description);
                    $this->aggregator->add($activity->getId(), $activity);
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
