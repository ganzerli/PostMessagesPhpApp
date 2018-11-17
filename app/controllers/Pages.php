<?php

class Pages extends Controller {
 
    public function __construct(){
       
    }

 //the idex page is the default then we have to specify it here too
    public function index(){
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

