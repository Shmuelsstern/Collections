<?php

Class Navbar extends BaseController{

    function setNavbar(){
        $viewmodel= new NavbarModel();
        $this->ReturnView($viewmodel->getNavbarData());
    }

    function setSessionFacility(){
        $viewmodel= new NavbarModel();
        $this->ReturnView($viewmodel->setSessionFacility($this->urlvalues['facility']));
    }

    function setAgingList(){
        $viewmodel= new NavbarModel();
        $this->ReturnView($viewmodel->setAgingList());
    }
}

?>