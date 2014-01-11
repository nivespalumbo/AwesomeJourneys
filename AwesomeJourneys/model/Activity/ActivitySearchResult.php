<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StaySearchResult
 *
 * @author anto
 */
class ActivitySearchResult {
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new StayConcreteAggregator();
    }
    
    /*
     * DA MODIFICARE, CREARE UN'ALTRA FUNZIONE PRIVATA CHE RICERCA IN DB
     */
    public function search(){
        $c = new Connection();
        
        $query = "SELECT * FROM activity INNER JOIN accomodation_template ON activity.template = accomodation_template.ID;";
        
        if($c){
            $table = $c->fetch_query($query);
            $c->close();
            if($table){
                $numRows = count($table,COUNT_NORMAL);
                for($i=0; $i<$numRows; $i++)
                    $this->aggregator->add(new Activity($table[$i]->ID, $table[$i]->template, $table[$i]->duration, $table[$i]->location, $table[$i]->description));
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
