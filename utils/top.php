<?php

include 'utils/security.php';

function getCSS(){
  global $controller;
    return "css/".$controller->getThisClass().".css";
}

function isVerifiedUser(){
  if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
    return true;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/RArrow.png" type="image/png" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>collections</title>
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<link rel='stylesheet' href= <?php echo getCSS(); ?>>
<?php if(isVerifiedUser()){echo "<link rel='stylesheet' href= 'css/Navbar.css'>";} ?> 
  </head>
  <body>
<?php if(isVerifiedUser()){include 'utils/topNavbar.php';} ?>  