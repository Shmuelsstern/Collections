<?php


spl_autoload_register(function($class){
	include_once 'Objects/'.$class.'.php';
});

Class AgingSpreadsheet{

	private $agingTableId;
    private $facility_id;
    private $earliest_reference_date;
    private $latest_reference_date;
    private $AgingSpreadsheetRow;
    private $agingCSVFileName;
	private $handle;
	private $agingSpreadsheetRowFields;
	private $rowsCounter=0;

	public function __construct($agingTableId,$facility_id,$latest_reference_date,$earliest_reference_date,$agingCSVFileName){
			$this->agingTableId=$agingTableId;
			$this->facility_id=$facility_id;
			$this->earliest_reference_date=$earliest_reference_date;
			$this->latest_reference_date=$latest_reference_date;
			$this->agingCSVFileName=$agingCSVFileName;
			echo $agingCSVFileName;
	}

	

	public function setAgingSpreadsheetRow(){
		#$this->agingSpreadsheetRowFields=fgetcsv($this->handle);
		if (!isset($this->AgingSpreadsheetRow)){
			$this->AgingSpreadsheetRow= new AgingSpreadsheetRow($this->facility_id,$this->agingSpreadsheetRowFields);
		}else{
			$this->AgingSpreadsheetRow->setProperties($this->facility_id,$this->agingSpreadsheetRowFields);
		}
	}
		
	public function loadTables(){
		$this->handle=fopen($this->agingCSVFileName,'r',true);
		while($this->agingSpreadsheetRowFields=fgetcsv($this->handle)){
			$this->rowsCounter++;
			$this->setAgingSpreadsheetRow();
			$responsiblePayerId=$this->loadTablesRow();
		}
		fclose($this->handle);
		return [$this->rowsCounter,$responsiblePayerId];
	}

	public function loadTablesRow(){
		set_time_limit ( 0 );
		$insertResponsiblePayerQuery = new PreparedQuery('INSERT INTO collections.responsible_payer (patient_id,payer_type_id,payer) VALUES (?,?,?)',[$this->AgingSpreadsheetRow->getPatient_id(),$this->AgingSpreadsheetRow->getPayer_type_id(),$this->AgingSpreadsheetRow->getPayer()]);
		$responsiblePayerId=$insertResponsiblePayerQuery->insert()->lastInsertId();

		$date=date("Y-m-d",strtotime("-1 month $this->latest_reference_date"));
		foreach($this->AgingSpreadsheetRow->getBalances() as $balance){
			if (strtotime($date)<strtotime($this->earliest_reference_date)){
				$date='2000-01-01';
			}
			$month=date('n',strtotime($date));
			$year=date('y',strtotime($date));
			$monthFrom2000= $year*12+$month;
			if(($balance!==0)&&($balance!=="")&&($balance!=='-')){
				$insertMonthlyBalanceQuery=new PreparedQuery('INSERT INTO collections.monthly_aging_balances(aging_table_id,responsible_payer_id,monthly_balance,month_from_2000) VALUES (?,?,?,?)',[$this->agingTableId,$responsiblePayerId,$balance,$monthFrom2000]);
				$insertMonthlyBalanceQuery->insert();
			}
		$date=date("Y-m-d",strtotime("-1 month $date"));
		}
		set_time_limit ( 30 );
		return $responsiblePayerId;
	}

}

Class AgingSpreadsheetRow{
	private $facility_id;
	private $fields=[];
    private $facility_patient_id;
    private $patient_id;
    private $payer_type_id;
    private $payer;
    private $balances=[];
	

	public function __construct($facility_id,$fields){
		$this->setProperties($facility_id,$fields);
        /*$this->facility_id=$facility_id;
		$this->facility_patient_id=$fields[0];
		$this->setPatient_id();
        $this->payer_type_id=$fields[1];
        $this->payer=$fields[2];
        $this->balances=array_slice ($fields,3);*/
    }

	public function setProperties($facility_id,$fields){
		 $this->facility_id=$facility_id;
		$this->facility_patient_id=$fields[0];
		$this->setPatient_id();
        $this->payer_type_id=$fields[1];
        $this->payer=$fields[2];
        $this->balances=array_slice ($fields,3);
	}

	public function getFields(){
		return $this->fields;
	}

    public function getFacility_patient_id(){
		return $this->facility_patient_id;
	}

	public function setFacility_patient_id($facility_patient_id){
		$this->facility_patient_id = $facility_patient_id;
	}

	public function getPatient_id(){
		return $this->patient_id;
	}

	public function setPatient_id(){
		$getPatientIdQuery= new PreparedQuery('SELECT patient_id from collections.patients where facility_patient_id = ? and facility_id = ?',[$this->facility_patient_id,$this->facility_id]);
		$patient_id = $getPatientIdQuery->getArrayofResults();
		$this->patient_id=$patient_id[0];
	}

	public function getPayer_type_id(){
		return $this->payer_type_id;
	}

	public function setPayer_type_id($payer_type_id){
		$this->payer_type_id = $payer_type_id;
	}

	public function getPayer(){
		return $this->payer;
	}

	public function setPayer($payer){
		$this->payer = $payer;
	}

	public function getBalances(){
		return $this->balances;
	}

	public function setBalances($balances){
		$this->balances = $balances;
	}
}

?>