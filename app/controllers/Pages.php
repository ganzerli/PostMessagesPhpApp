<?php

class Pages extends Controller {
 
    public function __construct(){
       
    }

 //the idex page is the default then we have to specify it here too
    public function index(){
        // if the user is logged in or not the view is different for this route, so if user is logged in whenever is linked to pages/index -default page gets another view , more userful for logged in users 
        if(isLoggedIn()){
            redirect("posts/index");
        }
        
        $data = [
            "title" => "Postaround!",
            "description" => "Application to share post built on ganzerliMVC PHP framework"
        ];
// extending Controller, trere s access to view, view takes the page to load and other parameters if there are 
         $this->view("pages/index", $data);//set in folder views
    }

    public function about(){
        $data =[
            "title" => "About Us",
            "description" => "App to share posts with other users"
        ];

        $this->view("pages/about", $data);
    }
}

