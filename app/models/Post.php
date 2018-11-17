<?php
class Post {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }
    // this class is is´nstanciated automatically in bootstrap
    public function getPosts(){

        // create a join with the users table, user and post hava an id , is needed an alias for the post user id
        // the first lines are alias for the db to know for example not to overwrite the creation_date but just separate them also in the joined posts table , preparing the object to send as response
        $this->db->query('SELECT * ,
                        posts.id as postId, users.id as userId,
                        posts.creation_date as postCreationDate, users.creation_date as userCreationDate
                        FROM posts
                        INNER JOIN users              
                        ON posts.user_id = users.id  
                        ORDER BY posts.creation_date DESC
                        ');
        // now should be possible to access the user datas within the posts wiew

        // fills the posts tables with the fields of users, and fills the tables of the posts with the fields of users targeting
        //the posts.user_id to choose which users tables goes in which posts table for each row in posts.
        $results = $this->db->resultSet();

        return $results;
    }

    public function addPost($data){
        $this->db->query('INSERT INTO posts (title, user_id, body) VALUES(:title , :user_id , :body)');
       
        // bind the validate values
        $this->db->bind(":title", $data["title"]);
        $this->db->bind(":user_id", $data["user_id"]);
        $this->db->bind(":body", $data["body"]);

        // when inserting or updating deleting , calling the execute method frm the Database library
        if($this->db->execute()){
            return true;
            //all ok
        }else{
            return false;
        }
    }

    public function getPostById($id){
        $this->db->query("SELECT * FROM posts WHERE id = :id");
        //bind id
        $this->db->bind(":id",$id);
        $row=$this->db->single();
        return $row;
    }


    public function updatePost($data){
        $this->db->query("UPDATE posts SET title = :title, body = :body WHERE id = :id");
       
        // bind the validate values
        $this->db->bind(":id", $data["postId"]);
        $this->db->bind(":title", $data["title"]);
        $this->db->bind(":body", $data["body"]);

        // when inserting or updating deleting , calling the execute method frm the Database library
        if($this->db->execute()){
            return true;
            //all ok
        }else{
            return false;
        }
    }

    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(":id",$id);
        return $this->db->execute()?true:false;
    }
}