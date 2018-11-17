<?php
// allow the session unctionality
session_start();

// FLASH MESSAGE
// EXAMPLE - flash("register_success" , "you are now registered", "alet alert-danger"), last optional, have default
// DISPLAY IN THE VIEW - <?php  echo flash("register_success");   ? >
function flash($name="", $message="", $class="alert alert-success"){
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION[$name])){ // check for message, and if the session record is free

            if(!empty($_SESSION[$name])){ // if record already there , unset
                unset($_SESSION[$name]);
            }

            if(!empty($_SESSION[$name."_class"])){
                unset($_SESSION[$name."_class"]);
            }
            //with sessio field free, write new record for this session
            $_SESSION[$name] = $message;
            $_SESSION[$name."_class"] = $class;

        }else if(empty($message) && !empty($_SESSION[$name])){ //if session already set but no message
            $class = !empty($_SESSION[$name."_class"]) ? $_SESSION[$name."_class"] : "";
            echo '<div class="'.$class.'">' .$_SESSION[$name].  '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }

    }
}


 function isLoggedIn(){
    //check for the session for example protected routes
    return isset($_SESSION["user_id"]);
}
