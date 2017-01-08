<?php

class Login extends BaseController {

	protected function displayLogin() {
	    $this->setSessionControllerAction();
		$viewmodel = "";
		$this->ReturnView($viewmodel);
	}

    protected function verifyLogin(){
        $viewmodel= new LoginModel();
        $this->ReturnView($viewmodel->verifyLogin());
    }

    protected function logoff(){
        session_unset();
        header('Location: index.php?');
    }
}

?>