<?php

class ResponsiblePayer{

    private $payerType;
    private $payer;
    private $responsiblePayerId;
    private $patientId;
    private $agingTableId;

    public function __construct($data){
        $this->payerType= $data['payer_type'];
        if(isset( $data['payer'])&&!empty( $data['payer'])){
            $this->payer = $data['payer'];
        }
        $this->responsiblePayerId = $data['responsible_payer_id'];
        $this->patientId= $data['patient_id'];
        $this->agingTableId= $data['aging_table_id'];
    }

    public function getResponsiblePayerId(){
        return $this->responsiblePayerId;
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