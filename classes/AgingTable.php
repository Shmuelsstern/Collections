<?php

spl_autoload_register(function($class){
	include_once 'Objects/'.$class.'.php';
});


Class AgingTable {
    private $aging_id;
    private $aging_name;
    private $facility_id;
    private $earliest_reference_date;
    private $latest_reference_date;
    private $amountOfLines;

    public function __construct($facility_id,$latest_reference_date,$earliest_reference_date){
        $this->aging_name=$this->getFacilityName($facility_id).$earliest_reference_date.$latest_reference_date;
        $this->facility_id=$facility_id;
        $this->earliest_reference_date=$earliest_reference_date;
        $this->latest_reference_date=$latest_reference_date;
    }

    public function getAging_id(){
        return $aging_id;
    }

    public function getAging_name(){
        return $aging_name;
    }

    public function getFacility_id(){
        return $facility_id;
    }

    public function getEarliest_reference_date(){
        return $earliest_reference_date;
    }

    public function getLatest_reference_date(){
        return $latest_reference_date;
    }

    public function getFacilityName($facility_id){
        $dbConnect =DbConnect::getDbInstance();
        $facilityQuery= new PreparedQuery('select facility_name FROM collections.facilities WHERE facility_id = ?',[$facility_id]);
        $resultsArray=$facilityQuery->getArrayofResults();
        return $resultsArray[0];
    }

    public function loadTable(){
        $InsertQuery= new PreparedQuery('INSERT into collections.aging_table (aging_name,facility_id,latest_reference_date,earliest_reference_date) VALUES (?,?,?,?)',[$this->aging_name, $this->facility_id,$this->latest_reference_date,$this->earliest_reference_date]);
        $agingTableId=$InsertQuery->insert()->lastInsertId();
        return $agingTableId;
    }

    public function insertNumberOfRows($rowsInAging,$highestIndexResponsiblePayer,$agingId){
        $UpdateQuery= new Query('UPDATE `aging_table` SET `rows_in_aging`=$rowsInAging, highest_index_responsible_payer = $highestIndexResponsiblePayer WHERE aging_id = $agingId');
        $UpdateQuery->insert();
    }

}

?>