<?php

$userName=$_POST['userName'];

spl_autoload_register(function($class){
	include_once 'Objects/'.$class.'.php';
});

function unverified(){
    header('Location: index.php?verifyError=true');
}

$verifyUserNameQuery = new PreparedQuery('SELECT password 
                                        FROM user_names 
                                        WHERE user_name = ?',[$userName]);
$hashedPassword=$verifyUserNameQuery->getResultsArrayArray();

echo $hashedPassword;

if(empty($hashedPassword) || !password_verify ($_POST['password'],$hashedPassword[0][0])){
    unverified();
}else{
    $_SESSION['user']=$userName;
    echo $_SESSION['user'];
    //header('Location: index.php?');
}


?>