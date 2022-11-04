<?php 

    include('config.php');
    include('./classes/Site.php'); 
    include('./classes/MySql.php');
    SITE::updateUsuarioOnline(); 
    SITE::contador(); 

    $homeController = new \Controller\HomeController;
    $aulaController = new \Controller\AulaController;

    Router::get('/', function() use ($homeController){
       $homeController->index(array('nome'=>'JoãoPedro'));
    });
    Router::get('/aula_single/?',function($arg) use ($aulaController){
        $aulaController->index($arg);
    });
    Router::get('?/?',function($par) {
  
    });
    /*
    Router::get('login',function(){
        echo 'login';
    });*/
    



?>