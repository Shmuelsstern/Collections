<?php
Class Query{

    protected $queryString;

    public function __construct($queryString){
        $this->queryString=$queryString;
    }

    public function getConnection(){
        include_once 'DbConnect.php';
        $dbInstance=DbConnect::getDbInstance();
        return $dbInstance->getDbConnection();
    }

    public function getResultsArrayArray(){
        $dbConnection=$this->getConnection();
        $queryStatement=$dbConnection->query($this->queryString);
        $queryResults=$queryStatement->fetchAll();
        $queryStatement->closeCursor();
        return $queryResults;
    }

    public function getArrayofResults(){
        $result=$this->getResultsArrayArray();
        $resultsArray=$result[0];
        return $resultsArray;
    }

    
    public function insert(){
        $dbConnection=$this->getConnection();  
        $dbConnection->exec($this->queryString); 
    }

} 

?>