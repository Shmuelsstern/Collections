<?php 

spl_autoload_register(function($class){
    $directories=['classes','models','controllers'];
    foreach( $directories as $directory){
        if (file_exists($directory.'/'.$class.'.php')){
            include $directory.'/'.$class.'.php';
        }
    };
});

session_start();

if ((!isset($_SESSION['user']) || empty($_SESSION['user']))  &&(!(isset($_GET['controller'])&&($_GET['controller']==='Login')))){
    $_GET['controller']='Login';
    $_GET['action']='displayLogin';
}

//create the controller and execute the action
$loader = new Loader($_GET);
$controller = $loader->CreateController();
$controller->ExecuteAction();

?>
