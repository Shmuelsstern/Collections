<?php

class IndividualBalanceModel extends BaseModel{
    private $facility;
    private $patient;
    private $collectible;

    function __constructor($monthlyBalanceId){
        //print_r($monthlyBalanceId);
        //print_r($this->getBalanceInfo($monthlyBalanceId));
    }

    function getBalanceInfo($monthlyBalanceId){
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
                                             WHERE mab.monthly_balance_id = ?',[$monthlyBalanceId]);
        return $balanceInfoQuery->getArrayofResults(PDO::FETCH_ASSOC);                                     
    }                                        

}

?>