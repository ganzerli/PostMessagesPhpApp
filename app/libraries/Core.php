<?php
/*
    * App Core Class
    * creates URL and loads core controller
    *   URL FORMAT - /controller/metgod/params
*/
    class Core {
// if we dont have other controllers is loading that
    protected $currentController ="Pages";
    protected $currentMethod ="index";
    protected $params = [];


    public function __construct(){
 
      $url = $this->getUrl();

      // Looks in Controllers for the first value of the parameters
      if(file_exists('../app/controllers/'.ucwords( $url[0] ).".php"  )){
              // If it exists , set as controller
            $this->currentController = ucwords($url[0]); // uc = Upper Case
              // Unset 0 Index
            unset($url[0]);
      }
      
        // require the controller, whatever is in $currentController gets required 
        require_once "../app/controllers/". $this->currentController.".php";
        // instanciating the controller Class.. Pages is default, so Pages.php get loaded

        $this->currentController = new $this->currentController;

        // see if the url has other parameters for use to call the methods in the Class
        if(isset($url[1])){
            //check if the methods exists in the chosen controller (class in controller folder
           if(method_exists($this->currentController, $url[1])){

            $this->currentMethod = $url[1];
                //unset 1 index
            unset($url[1]);
           }
        }

      // taking the parameters
      $this->params = $url ? array_values($url) :[];
        //call the class fires the method and gives the othre parameters as args to the method!! 
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
      

    }

    public function getUrl(){
      if(isset($_GET["url"])){
          $url = rtrim($_GET["url"],"/");
          //blocks every char that a url should not have  
          $url = filter_var($url, FILTER_SANITIZE_URL);
          // split into array
          $url = explode("/",$url);     
          return $url;
      }  
    }
  } 
  
  