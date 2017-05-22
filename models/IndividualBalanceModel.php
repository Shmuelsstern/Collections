<?php

class IndividualBalanceModel extends BaseModel{

    private $monthlyBalanceId;
    private $dataObject;
    private $facility;
    private $patient;
    private $responsiblePayer;
    private $monthlyBalance;
    

    function __construct($monthlyBalanceId){
        $this->monthlyBalanceId=$monthlyBalanceId;
    }

    function getBalanceInfo(){
        $this->dataObject=$this->queryBalanceInfo(); 
        $this->setFacility();
        $this->setPatient();
        $this->setResponsiblePayer();
        $this->setMonthlyBalance();
        return ['facility'=>$this->facility,'patient'=>$this->patient,'responsiblePayer'=>$this->responsiblePayer,'monthlyBalance'=>$this->monthlyBalance];
    } 

    function queryBalanceInfo(){
        $balanceInfoQuery=new PreparedQuery('SELECT * 
                                             FROM monthly_aging_balances mab
                                             JOIN responsible_payer rp 
                                             ON mab.responsible_payer_id = rp.responsible_payer_id
                                             JOIN payer_type pt
                                             ON rp.payer_type_id = pt.payer_type_id
                                             JOIN patients p 
                                             ON rp.patient_id = p.patient_id
                                             JOIN facilities f 
                                             ON p.facility_id = f.facility_id
                                             WHERE mab.monthly_balance_id = ?',[$this->monthlyBalanceId]);
        return $balanceInfoQuery->getArrayofResults(PDO::FETCH_ASSOC);
    }  

    function setFacility(){
        $this->facility= new Facility($this->dataObject);
    }  

    function setPatient(){
        $this->patient= new Patient($this->dataObject);
    } 

    function setResponsiblePayer(){
        $this->responsiblePayer= new ResponsiblePayer($this->dataObject);
    }                                  

    function setMonthlyBalance(){
        $this->monthlyBalance = new MonthlyBalance($this->dataObject,$this->monthlyBalanceId);
    }
}

?>