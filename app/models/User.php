<?php
class User {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // chech for the email
    public function findUserByEmail($email){
        // prepare the query
        $this->db->query('SELECT * FROM users WHERE email = :email');
        //bind the data to the query
        $this->db->bind(':email',$email);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    // Registering the user
    public function register($data){ // data array includes everything, also hashed password, see controller Users
        //  preparing statement
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name , :email , :password)');
       
        // bind the validate values
        $this->db->bind(":name", $data["name"]);
        $this->db->bind(":email", $data["email"]);
        $this->db->bind(":password", $data["password"]);

        // when inserting or updating deleting , calling the execute method frm the Database library
        if($this->db->execute()){
            return true;
            //all ok
        }else{
            return false;
        }

    }

    public function login($email, $password){
        //finding the user with the email
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(":email",$email);

        $row = $this->db->single();

        $hashed_password = $row->password;

        if(password_verify($password, $hashed_password)){
            return $row; // the entire user row
        }else{
            return false;
        }

        $this->db->execute();
    }
}