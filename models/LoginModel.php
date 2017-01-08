<?php

class LoginModel extends BaseModel{

    private $userName;
    private $password;
    private $error;

    function __construct(){
        $this->userName=$_POST['userName'];
        $this->password=$_POST['password'];
    }

    function verifyLogin(){
        echo 'verifying';
        $verifyUserNameQuery = new PreparedQuery('SELECT password 
                                                  FROM user_names 
                                                  WHERE user_name = ?',[$this->userName]);
        $hashedPassword=$verifyUserNameQuery->getResultsArrayArray(); 
        if(empty($hashedPassword) || !password_verify ($_POST['password'],$hashedPassword[0][0])){
            $this->error='The user name and password combination are not valid';
            return $this->error;
        }else{
            $_SESSION['user']=$this->userName;
            header('Location: index.php?');
        }                                         
    }
}

?>