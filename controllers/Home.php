<?php

Class Home extends BaseController {

    function index(){
	    $this->setSessionControllerAction();
        $viewmodel='';
        $this->ReturnView($viewmodel);
    }
}

?>