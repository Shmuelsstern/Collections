<?php

class MonthlyBalance{

    private $monthsArray=['Dec','Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov'];
    private $monthInt;
    private $monthStr;
    private $year;
    private $monthlyBalance;
    private $monthlyBalanceId;
    private $beginOfMonth;
    private $beginOfMonthSql;
    private $endOfMonth;
    private $endOfMonthSql;

    public function __construct($data,$monthlyBalanceId){
        $this->monthInt=$data['month_from_2000']%12;
        $this->monthStr = $this->monthsArray[$this->monthInt];
        $this->year = floor($data['month_from_2000']/12);
        $this->monthlyBalance= $data['monthly_balance'];
        $this->monthlyBalanceId= $monthlyBalanceId;
        $this->setBeginAndEnd();
    }

    public function render(){
        return "    <div class ='col-xs-2 padding-right-0'>
                        <h4>".$this->monthStr.' 20'.$this->year."</h4>
                    </div>
                    <div class ='col-xs-1'>
                        <h4><strong>$".$this->monthlyBalance."</strong></h4>
                    </div>";
    }

    public function setBeginAndEnd(){
        $year=$this->year+2000;
        $daysInMonth=date("t",mktime(0,0,0,$this->monthInt,1,$year));
        $this->beginOfMonth=$this->monthInt.'/1/'.$year;
        $this->beginOfMonthSql=$year.'-'.$this->getTwoDigitMonth($this->monthInt).'-01';
        $this->endOfMonth=$this->monthInt.'/'.$daysInMonth.'/'.$year;
        $this->endOfMonthSql=$year.'-'.$this->getTwoDigitMonth($this->monthInt).'-'.$daysInMonth;
    }

    public function getBeginOfMonthSql(){
        return $this->beginOfMonthSql;
    }

    public function getEndOfMonthSql(){
        return $this->endOfMonthSql;
    }
    
    public function getMonthlyBalanceId(){
        return $this->monthlyBalanceId;
    }

    public function getTwoDigitMonth($month){
        if($month<10){
            return '0'.$month;
        }else{
            return $month;
        }
    }
}
?>