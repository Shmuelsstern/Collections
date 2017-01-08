<?php

abstract class BaseController {
	protected $urlvalues;
	protected $action;
	public $viewmodel;
	
	public function __construct($action, $urlvalues) {
		$this->action = $action;
		$this->urlvalues = $urlvalues;
	}
	
	public function ExecuteAction() {
		return $this->{$this->action}();
	}
	
	protected function ReturnView($viewmodel/*, $fullview*/) {
		$this->viewmodel=$viewmodel;
		$viewloc = 'views/' . get_class($this) . '/' . $this->action . '.php';
		/*if ($fullview) {
			require 'views/maintemplate.php';
		} else {*/
			require $viewloc;
		/*}*/
	}

    public function getThisClass(){
        return get_class($this);
    }

	
	public function setSessionControllerAction(){	
		$_SESSION['controller']=$this->getThisClass();
		$_SESSION['action']=$this->action;
	}

}

?>