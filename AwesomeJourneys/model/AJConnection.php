<?php

define('HOST', 'localhost');
define('UTENTE', 'root');
define('PASS', '');
define('DB', 'awesome_journeys');

class AJConnection {
    private $link;
	
    function __construct(){
        $this->link = @mysql_connect(HOST, UTENTE, PASS) or die('Errore nella connessione: ' . mysql_error());
        @mysql_select_db(DB, $this->link) or die('Errore dal database: ' . mysql_error());
    }
    
    public function registra($name, $surname, $address, $tel, $email) {
        if($this->link){            
            //procede con la registrazione
            $result = @mysql_query("INSERT INTO personal_data(username, name, surname, address, telephone) VALUES ('".$email."', '".$name."','".$surname."','".$address."','".$tel."')") or die('Errore: ' .mysql_error());
            return $result;
        }
    }
    
    public function newCreator($email, $password){
        if($this->link){
            $result = @mysql_query("INSERT INTO creator(username, password, role) VALUES ('".$email."','".$password."','customer');");
            return $result;
        }
    }
    
    public function verificaLogin($user, $pass) {
        if($this->link){
            $query = @mysql_query("SELECT creator.username AS mail, role, name, surname, address, telephone FROM creator INNER JOIN personal_data ON creator.username = personal_data.username WHERE creator.username = '".$user."' AND creator.password = '".$pass."'") or die('Errore: ' . mysql_error());
            if (@mysql_num_rows($query) == 1) {
                //viene generata la sessione di login
                return @mysql_fetch_object($query);
            } else 
                return FALSE;
        }
    }
    
    public function executeQuery($query){
        if($this->link){
            $tabella = @mysql_query($query) or die(@mysql_error());
            if($tabella){
                $risultato = NULL;
                while($row = @mysql_fetch_object($tabella)){
                    $risultato[] = $row;
                }
                return $risultato;
            }
            return FALSE;
        }
    }
    
    public function executeNonQuery($sql){
        if($this->link){
            $ris = @mysql_query($sql) or die(@mysql_error());
            return $ris;
        }
        return FALSE;
    }
    
    public function beginTransaction(){
        @mysql_query("SET AUTOCOMMIT=0");
        @mysql_query("START TRANSACTION");
    }
    
    public function commit(){
        @mysql_query("COMMIT");
    }
    
    public function rollback(){
        @mysql_query("ROLLBACK");
    }
    
    public function lastInsertedId(){
        return mysql_insert_id();
    }
	
    public function close(){
        @mysql_close($this->link);
    }
}

?>
