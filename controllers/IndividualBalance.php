<?php

class IndividualBalance extends BaseController{

    function render(){
        $viewmodel=new IndividualBalanceModel($this->urlvalues['monthlyBalanceID']);
        $this->ReturnView($viewmodel->getBalanceInfo($this->urlvalues['monthlyBalanceID']));
    }
}

?>