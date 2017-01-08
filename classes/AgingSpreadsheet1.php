<?php

Class AgingSpreadsheet1{

    private $agingTableId;
    private $agingInfo;
    private $allBalancesInfo;
    private $baseResponsiblePayerId;
    private $responsiblePayersInfo;
    private $spreadsheetArray=[];
    private $latestReferenceDateAsMonthFrom2000;
    private $earliestReferenceDateAsMonthFrom2000;
    private $numberOfMonthsInAging;

    public function __construct($agingTableId){
        $this->agingTableId=$agingTableId;
        $this->setAgingInfo();
        $this->setAllBalancesInfo();
        $this->setResponsiblePayersInfo();
        $this->setBaseResponsiblePayerId();
        $this->setLatestAndEarliestReferenceDateAsMonthFrom2000();
        $this->setNumberOfMonthsInAging();
        $this->setSpreadsheetArray();
    }

    function setAgingInfo(){
        $AgingInfoQuery= new Query("SELECT * 
                                    FROM aging_table 
                                    WHERE aging_id = $this->agingTableId");
        $this->agingInfo=$AgingInfoQuery->getArrayofResults();
    }

    function setAllBalancesInfo(){
        $AllMonthlyBalancesQuery = new Query("SELECT monthly_balance_id,responsible_payer_id,monthly_balance,                                                           month_from_2000,is_worked_on 
                                                FROM monthly_aging_balances
                                                WHERE aging_table_id = $this->agingTableId");
        $this->allBalancesInfo= $AllMonthlyBalancesQuery->getResultsArrayArray();
    }

    function setResponsiblePayersInfo(){
        $ResponsiblePayersQuery = new Query("SELECT CONCAT(p.last_name, ', ', p.first_name) AS Name,  pt.payer_type AS 'Payer Type', rp.payer AS Payer
                                            FROM `responsible_payer` rp 
                                            JOIN `patients` p 
                                            ON rp.patient_id = p.patient_id 
                                            JOIN payer_type pt 
                                            ON rp.payer_type_id = pt.payer_type_id
                                            WHERE rp.aging_table_id = $this->agingTableId 
                                            ORDER BY rp.responsible_payer_id ");
        $this->responsiblePayersInfo=$ResponsiblePayersQuery->getResultsArrayArray();
    }

    function setBaseResponsiblePayerId(){
        $this->baseResponsiblePayerId=$this->agingInfo['highest_index_responsible_payer']-($this->agingInfo['rows_in_aging']);
    }

    function setLatestAndEarliestReferenceDateAsMonthFrom2000(){
        $this->latestReferenceDateAsMonthFrom2000=$this->convertDateToMonthFrom2000($this->agingInfo['latest_reference_date']);
        $this->earliestReferenceDateAsMonthFrom2000=$this->convertDateToMonthFrom2000($this->agingInfo['earliest_reference_date']);
        
    }

    function convertDateToMonthFrom2000($date){
        $month=date('n',strtotime($date));
        $year=date('y',strtotime($date));
        $monthFrom2000= $year*12+$month;
        return $monthFrom2000;
    }

    function setNumberOfMonthsInAging(){
        $this->numberOfMonthsInAging= $this->latestReferenceDateAsMonthFrom2000 - $this->earliestReferenceDateAsMonthFrom2000;
    }

    function setSpreadsheetArray(){
        foreach($this->allBalancesInfo as $balanceInfo){
            $this->spreadsheetArray[($balanceInfo['responsible_payer_id']-$this->baseResponsiblePayerId-1)][$this->latestReferenceDateAsMonthFrom2000-$balanceInfo['month_from_2000']+3]=$balanceInfo['monthly_balance'];
        }
    }

    function getOriginalSpreadsheet(){
        $spreadsheetFields=[];
        foreach($this as $key => $value){
            $spreadsheetFields[$key]=$value;
        }
        return $spreadsheetFields;
    }

    /*function getSpreadsheetView(){
        for($i=0;$i<$this->agingInfo['rows_in_aging'];$i++){ 
            echo '<tr>';
            for($k=1;$k<4;$k++){
                echo "<td>{$this->responsiblePayersInfo[$i][$k-1]}</td>";
            }
            for(;$k<=$this->getNumberOfMonthsInAging()+3;$k++){
                if(isset($this->spreadsheetArray[$i][$k])){
                    echo "<td>{$this->spreadsheetArray[$i][$k]}</td>";
                }else{
                    echo "<td></td>";
                }
            }
            echo '</tr>';
        }
    }  

    function getMonth($monthFrom2000){
        $mons = explode(" ","Dec Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov ");
        return $mons[$monthFrom2000%12];
    }

    function getYear($monthFrom2000){
        return floor($monthFrom2000/12);
    }

    function getSpreadsheetHead(){
        echo '<tr>';
        $keys=array_keys($this->responsiblePayersInfo[0]);
        foreach($keys as $key){
            if(gettype($key)!=='integer'){
            echo '<th>'.$key.'</th>';
            }
        }
        for($i=0;$i<$this->getNumberOfMonthsInAging();$i++){
            $monthFrom2000=$this->latestReferenceDateAsMonthFrom2000-1-$i;
            echo '<th>'.$this->getMonth($monthFrom2000)."'".$this->getYear($monthFrom2000).'</th>';
        }
        echo '</tr>';
    } 
    
*/
}
?>