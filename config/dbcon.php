<?php

class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'mvc_adminlte';

    private $connection = null;

    public function __construct() {
        try{	
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);		
            if( mysqli_connect_errno() ){
                throw new Exception("Connect Error: Could not connect to database.");   
            }
            $this->connection->query("SET NAMES 'utf8'");		
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }	
    }
    /*
    public function connect() {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        return $conn;
    }
    */
    public function prepare($query) { 
        try{
            $stmt = $this->connection->prepare($query);
            if($stmt === false) {
                throw New Exception("Connect Error: Unable to do prepared statement: " . $query);
            }
            return $stmt;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
    }

    public function executeStatement( $query = "" , $params = [] ) {	
        try{		
            $stmt = $this->connection->prepare( $query );		
            if($stmt === false) {
                throw New Exception("Connect Error: Unable to do prepared statement: " . $query);
            }		
            if( $params ){
                call_user_func_array(array($stmt, 'bind_param'), $params);				
            }
            //$stmt->execute();		
            return $stmt;		
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }   
    
    public function close() {
        $this->connection->close();
    }
}

?>