<?php 

session_start();


$user=false;
echo $_SESSION['user'];
if (isset($_SESSION['user']) && !empty($_SESSION['user'])){
    include 'home.php?';
}else{
    $page='login';
    include 'views/loginView.php';
}

?>
