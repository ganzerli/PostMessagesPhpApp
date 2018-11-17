<?php

// load config
  require_once "config/config.php";
  require_once "helpers/url_helper.php";
  require_once "helpers/session_helper.php";
  // Load Libraries
  //require_once 'libraries/core.php';
  //require_once 'libraries/controller.php';
  //require_once 'libraries/database.php';

  //AUTOLOAD CORE LIBRARIES

    spl_autoload_register(function($className){
      // filename needs to match the className
      require_once "libraries/" . $className . ".php";
    });
    //this requires automatically the file needed!!