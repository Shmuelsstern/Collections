<?php

Class Balances extends BaseController{

    function originalSpreadsheet(){
        $viewmodel=new BalancesModel();
        $this->ReturnView($viewmodel->originalSpreadsheet($this->urlvalues['agingID']));
    }
}

?>