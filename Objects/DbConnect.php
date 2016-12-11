<?php

class DbConnect{
	private $cs;
	private $user;
	private $password;
	private $dbInstance;
    private $dbConnection;

	private function __construct($cs = 'mysql:host=localhost;dbname=collections',$user = 'test',$password = 'welcome1'){
		$this->cs =$cs;
		$this->user = $user;
		$this->password =$password;
	

		try {
			$this->dbConnection= new PDO($cs, $user, $password);
		} 	catch(PDOException $e) {
			$error = $e->getMessage();
			echo 'error';
			exit;
		}
	}

	public static function getDbInstance(){
        if(!isset($dbInstance)){
           $dbInstance=new DbConnect(); 
        }
		return $dbInstance;
	}
	public function getDbConnection(){
		return $this->dbConnection;
	}

}

?>