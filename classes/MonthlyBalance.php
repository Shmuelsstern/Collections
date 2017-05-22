<?php

class MonthlyBalance{

    private $monthsArray=['Dec','Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov'];
    private $month;
    private $year;
    private $monthlyBalance;
    private $monthlyBalanceId;

    public function __construct($dataObject,$monthlyBalanceId){
        $this->month = $this->monthsArray[$dataObject['month_from_2000']%12];
        $this->year = floor($dataObject['month_from_2000']/12);
        $this->monthlyBalance= $dataObject['monthly_balance'];
        $this->monthlyBalanceId= $monthlyBalanceId;
    }

    public function render(){
        return "    <div class ='col-xs-2 padding-right-0'>
                        <h4>".$this->month.' 20'.$this->year."</h4>
                    </div>
                    <div class ='col-xs-1'>
                        <h4><strong>$".$this->monthlyBalance."</strong></h4>
                    </div>";
    }
}
?>