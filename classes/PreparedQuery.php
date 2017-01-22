<?php

class PreparedQuery extends Query{
        private $inputParameters;

        public function __construct($queryString, $params){
            parent::__construct($queryString);
            $this->inputParameters=$params;
        }

        public function getResultsArrayArray($fetch_style=PDO::FETCH_BOTH){
            $dbConnection=$this->getConnection();
            $preparedStatement=$dbConnection->prepare($this->queryString);
            $preparedStatement->execute($this->inputParameters);
            $queryResults=$preparedStatement->fetchAll($fetch_style);
            $preparedStatement->closeCursor();
            return $queryResults;
        }

        public function getArrayofResults($fetch_style=PDO::FETCH_BOTH){
            $result=$this->getResultsArrayArray($fetch_style);
            $resultsArray=$result[0];
            return $resultsArray;
        }
        
        public function insert(){
            $dbConnection=$this->getConnection();  
            $preparedStatement=$dbConnection->prepare($this->queryString); 
            $preparedStatement->execute($this->inputParameters);
        }
}
?>