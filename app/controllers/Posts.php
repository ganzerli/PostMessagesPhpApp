<?php
class Posts extends Controller{
    //index is the default method called for this controller/route

    public function __construct(){
        if(!isLoggedIn()){ // if a user_id is set in the $_SESSION returns true,
            redirect("users/login");
        }
        // loading the model
        $this->postModel = $this->model("Post"); //returns new Post model
        $this->userModel = $this->model("User");
    }


    public function index(){
        // Get posts 
    // fills the posts tables with the fields of users, and fills the tables of the posts with the fields of users targeting
    //the posts.user_id to choose which users tables goes in which posts table for each row in posts.
        $posts = $this->postModel->getPosts(); // selects all fro posts and joins the user table on the same post.user_id = user.id

        $data=[
            "posts" => $posts
        ];
        $this->view("posts/index",$data);
    }


    public function add(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
              //process the form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data =[
                "title" =>trim($_POST["title"]),
                "body" => trim($_POST["body"]),
                "user_id" => $_SESSION["user_id"],
                "err_title" =>"",
                "err_body" => ""
            ];
            // validation 
            if(empty($data["title"])){
                $data["err_title"] = "Please enter title"; 
            }
            if(empty($data["body"])){
                $data["err_body"] = "Please enter something"; 
            }

            // check for errors
            if(empty($data["err_title"]) && empty($data["err_body"]) ){
                // add to query end execute
                if($this->postModel->addPost($data)){ //postModel has a method to make the query bind the values from data array and insert in db
                    flash("post_message","Post Added");
                    redirect("posts/index");
                }else{
                    //load view with new errors if from DB
                    die("Something went wrong");
                }
            }else{
                //load view with errors
                $this->view("posts/add",$data);
            }

        }else{
            // if get show the empty form
            $data =[
                "title" => "",
                "body" => ""
            ];
    
            $this->view("posts/add",$data);
        }

    }
    // how the core works loclahost/postaround/index.php (pages/index) is set as root folder .htaccess apache it hase a rewrite base, it loads index.php, that require the libraries and instanciate the core, the core takes the url and get /Posts controller and /show method, /other following parameters are set in an array which we can accces , taking here as arg the parameter in the url 
    public function show($id){
        //taking the row from the DB
        $thePost = $this->postModel->getPostById($id);
        //looking in model folder for getPostById method

        // getting the user informations from user model imported in the constructor as userModel
        $userInfos = $this->userModel->getUserById($thePost->user_id);  
        $data =[
            "thePost" => $thePost,
            "userInfos" =>$userInfos
        ];

        $this->view("posts/show",$data);
    }


    public function edit($id){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
              //process the form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data =[
                "postId" => $id,
                "title" =>trim($_POST["title"]),
                "body" => trim($_POST["body"]),
                "user_id" => $_SESSION["user_id"],
                "err_title" =>"",
                "err_body" => ""
            ];
            // validation 
            if(empty($data["title"])){
                $data["err_title"] = "Please enter title"; 
            }
            if(empty($data["body"])){
                $data["err_body"] = "Please enter something"; 
            }

            // check for errors
            if(empty($data["err_title"]) && empty($data["err_body"]) ){
                // add to query end execute
                if($this->postModel->updatePost($data)){ //postModel has a method to make the query bind the values from data array and insert in db
                    flash("post_message","Post Updated !");
                    redirect("posts/index");
                }else{
                    //load view with new errors if from DB
                    $this->view("posts/edit",$data);
                }
            }else{
                //load view with errors
                $this->view("posts/add",$data);
            }
        }else{
            // get the post from db
            $post = $this->postModel->getPostById($id);
            //check for owner
            if($post->user_id !== $_SESSION["user_id"]){
                redirect("posts/index");
            }

            $data =[
                "postId" =>$id,
                "title" => $post->title,
                "body" => $post->body
            ];
    
            $this->view("posts/edit",$data);
        }

    }

    public function delete($id){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($this->postModel->deletePost($id)){
                flash("post_message","POST IS BEEN REMOVED");
                redirect("posts/index");
            }else{
                die("Something went wrong");
            }
        }else{
            redirect("posts/index");
        }
    }
}