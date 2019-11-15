<?php

  function classAutoLoader($class) {
    $class = strtolower($class);
    $the_path =  'includes/{$class}.php';

    if(is_file($the_path) && !class_exists($class)) {
     include  $the_path;
    }
  }

  spl_autoload_register('classAutoLoader'); 
  
  function redirect($location){
    header("location: {$location}");
  }

  function dd($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
  }

?>