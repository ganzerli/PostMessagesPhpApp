
<?php 
class Users extends Controller{
    public function __construct(){
        // loading the model
        $this->userModel = $this->model("User"); //func model($model) -> require_once '../app/models/' . $model . '.php'; and returns new $model();
        // User model initialized, methods of the User class can be used
    }

    public function register(){
    
        // handles loading the form and also when we submit the form-POST-req
        if($_SERVER["REQUEST_METHOD"] == "POST"){//checking the request to this route, method, is post
            //process the form
          
            //sanitize POST data 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data=[
                "name" => trim($_POST["name"]),
                "email" => trim($_POST["email"]),
                "password" => trim($_POST["password"]),
                "password2" =>trim($_POST["password2"]),
                "err_name"=>"",
                "err_email"=>"",
                "err_password" =>"",
                "err_password2" =>""
            ];
            // validation
            if(empty($data["email"])){
                $data["err_email"] = "Please enter Email";
            }else{
                if($this->userModel->findUserByEmail($data["email"])){
                    // the function just returns false 
                    $data["err_email"] = "Email is already taken";
                }
            }

            if(empty($data["name"])){
                $data["err_name"] = "Please enter Name";
            }

            if(empty($data["password"])){
                $data["err_password"] = "Please enter Password";
            }else if(strlen($data["password"]) < 6 ){
                $data["err_password"] = "Password must be at least 6 characters";
            }

            if(empty($data["password2"])){
                $data["err_password2"] = "Please confirm your password";
            }else if($data["password"] != $data["password2"]){
                $data["err_password2"] = "password does not match";
            }

            // last check if the thre are errors
            if(empty($data["err_name"]) && empty($data["err_email"]) && empty($data["err_password"]) && empty($data["err_password2"])){
               // everything is validated
               //hashing password; WITH STRONG ONE WAY HASHING ALGORYTHM ALSO COMPATIBLE WITH BCRYPT    
               $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
               // Register the user
               if($this->userModel->register($data)){ // queryes the DB if all is good returns true
                    //  REDIRECTING -- HEADER FUNCTION
                    flash('register_success', "You are Registered, you can now log in!");
                    redirect("users/login");

               }else{
                   die("something went wrong");
               }
               

            }
            $this->view("users/register",$data);

        }else{
            //init data
            $data=[
                "name" => "",
                "email" => "",
                "password" => "",
                "password2" =>"",
                "err_name"=>"",
                "err_email"=>"",
                "err_password" =>"",
                "err_password2" =>""
            ];
        //load the view
        $this->view("users/register",$data);
        }

    }

    public function login(){
            // handles loading the form and also when we submit the form-POST-req
        if($_SERVER["REQUEST_METHOD"] == "POST"){
              //process the form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data=[
                "email" => trim($_POST["email"]),
                "password" => trim($_POST["password"]),
                "err_email"=>"",
                "err_password" =>"",
            ];
               // validation
            if(empty($data["email"])){
                $data["err_email"] = "Please enter Email";
            }

            if(empty($data["password"])){
                $data["err_password"] = "Please enter Password";
            }else if(strlen($data["password"]) < 6 ){
                $data["err_password"] = "Password must be at least 6 characters";
            }

            //check for user / email
            if($this->userModel->findUserByEmail($data["email"])){
                //user found
            }else{
                $data["err_email"] = "No user found";
            }


              // last check if the thre are errors
            if(empty($data["err_email"]) && empty($data["err_password"])){
            
               // check and set logged in user
               $loggedInUser = $this->userModel->login($data["email"], $data["password"]);
                //login looks in the db for the password of the user with that email and compare them
                if($loggedInUser){// method login return false if email or password does not match , or the user row
                   // create session
                    $this->createUserSession($loggedInUser);
                }else{
                    //rerender the form with error
                    $data["err_password"] = "Password incorrect";
                    $this->view("users/login",$data);
                }

            }else{
                //show view with errors
                $this->view("users/login",$data);
            }

            
        }else{
                //init data
                $data=[
                    "email" => "",
                    "password" => "",               
                    "err_email"=>"",
                    "err_password" =>"",
                ];
            //load the view
            $this->view("users/login",$data);
    
            }
    }

    public function createUserSession($loggedUser){
        $_SESSION["user_id"] = $loggedUser->id;
        $_SESSION["user_email"] = $loggedUser->email;
        $_SESSION["user_name"] = $loggedUser->name;
        redirect("pages/index");
    }

    public function logout(){
        unset($_SESSION["user_id"]);
        unset($_SESSION["user_email"]);
        unset($_SESSION["user_name"]);
        session_destroy();
        redirect("users/login");
    }
    public function isLoggedIn(){
        //check for the session for example protected routes
       return isset($_SESSION["user_id"]);
    }
}
