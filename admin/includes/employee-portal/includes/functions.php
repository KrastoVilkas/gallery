<?php

  //__autoload may be deprecated in the future
  //so we create a custom function which makes use of __spl_autoload_Register
  function classAutoLoader($class){
    $class = strtolower($class);
    $filepath = "includes/{$class}.php";

    if(is_file($filepath) && !class_exists($class)){
      require_once($filepath);
    }else{
      die("The file named {class}.php was not found");
    }
  }

  function redirect($location){
    header("Location: {$location}");
  }

spl_autoload_register("classAutoLoader");

 ?>
