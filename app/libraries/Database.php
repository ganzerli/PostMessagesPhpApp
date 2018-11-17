<?php
/*
*
* PDO Database Class
* Connect to Database
* Create Preapred Statement
* Return rows and results 
*/
class Database {
    // CONSTANSTS importedin bootstrap from config
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    //to prepare the statement
    private $dbHandler;
    private $statement;
    private $error;

    public function __construct(){
        // set DSN
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        //persisting connection, this increases performance, by checking to see if a connection is already established with th DB
        
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  //elegant way to handle errors
        );
    
        //Create PDO instance
        try{
            $this->dbHandler = new PDO($dsn, $this->user, $this->pass , $options);
        }catch(PDOException $expt){
            $this->error = $expt->getMessage();// gives the error message
            echo $this->error;
        }
    }
     
    
    // Prepare statement with query
        public function query($sql){
            $this->statement = $this->dbHandler->prepare($sql);
        }

        // method to bind the values
        public function bind($param , $value , $type = null){
            if(is_null($type)){
                switch(true){ // it runs always
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->statement->bindValue($param, $value, $type);
        }
    //execute the prepared statement
    public function execute(){
            return $this->statement->execute();
    }

    // Get result set, [{},{},{},...]
     public function resultSet(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }
    // Get row count
    public function rowCount(){
        return $this->statement->rowCount(); // a method part of PDO
    }

}