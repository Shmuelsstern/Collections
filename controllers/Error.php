<?php

class Error extends BaseController{

    private $errorName;

    public function __construct($errorName,$urlValues){
        parent::__construct('printError',$urlValues);
        $this->errorName= $errorName;
    }

    
    function printError(){
        $viewmodel= $this->errorName;
        $this->ReturnView($viewmodel);
    }
}

?>