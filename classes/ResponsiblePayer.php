<?php

class ResponsiblePayer{

    private $payerType;
    private $payer;
    private $responsiblepayerId;

    public function __construct($dataObject){
        $this->payerType= $dataObject['payer_type'];
        $this->payer = $dataObject['payer'];
        $this->responsiblepayerId = $dataObject['responsible_payer_id'];
    }

    public function render(){
        return "   <div class ='col-xs-4'>
                        <h4>".$this->payerType."</h4>
                    </div>
                    <div class ='col-xs-4'>
                        <h4>".$this->payer."</h4>
                    </div>";
    }
}
?>