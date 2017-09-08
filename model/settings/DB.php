<?php
    
    Class DB{			
        private $db;
			        
        //Connection database. Here _DBPATH_ is path of database and _DBNAME_ is name of database.
        function __construct(){
            try {$this->db = new PDO ( 'sqlite:'.dirname(__FILE__).'/../../model/'._DBPATH_.'/'._DBNAME_.'.db' );} 
            catch ( PDOException $e ) {print $e->getMessage ();}
        }
        
        //Query
        function query($value){
            return $this->db->query($value);
        }
        
        //Execute
        function execute($value){
            return $this->db->execute($value);
        }
        
        //Prepare
        function prepare($value){
            return $this->db->prepare($value);
        }
        
        //Insert last id
        function lastInsertId(){
            return $this->db->lastInsertId();
        }
        
        //Close the connection
        function __destruct(){
            
            return $this->db = NULL;
            
        }
        
    }


?>
