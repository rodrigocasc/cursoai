<?php
use Bramus\Router\Router;
error_reporting(0); // SET 0 FOR PROD, SET -1 FOR DEVELOPEMENT
date_default_timezone_set("America/Sao_Paulo"); // DEFAULT CONFIG HOURS 

    $router = new Router();

    require "api.php";
    
    $router->run();