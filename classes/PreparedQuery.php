<?php

class PreparedQuery extends Query{
        private $inputParameters;

        public function __construct($queryString, $params){
            parent::__construct($queryString);
            $this->inputParameters=$params;
        }

        public function getResultsArrayArray(){
            $dbConnection=$this->getConnection();
            $preparedStatement=$dbConnection->prepare($this->queryString);
            $preparedStatement->execute($this->inputParameters);
            $queryResults=$preparedStatement->fetchAll();
            $preparedStatement->closeCursor();
            return $queryResults;
        }

        public function getArrayofResults(){
            $result=$this->getResultsArrayArray();
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