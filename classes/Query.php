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

    public function getResultsArrayArray($fetch_style=PDO::FETCH_BOTH){
        $dbConnection=$this->getConnection();
        $queryStatement=$dbConnection->query($this->queryString);
        $queryResults=$queryStatement->fetchAll($fetch_style);
        $queryStatement->closeCursor();
        return $queryResults;
    }

    public function getArrayofResults($fetch_style=PDO::FETCH_BOTH){
        $result=$this->getResultsArrayArray($fetch_style);
        $resultsArray=$result[0];
        return $resultsArray;
    }

    
    public function insert(){
        $dbConnection=$this->getConnection();  
        $dbConnection->exec($this->queryString); 
    }

} 

?>