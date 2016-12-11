<?php

if(isset($_GET['facility'])){
    $facilityId=$_GET['facility'];
}

if(isset($_GET['latest_reference_date'])){
    $latest_reference_date=getFormattedDate($_GET['latest_reference_date']);
}

if(isset($_GET['earliest_reference_date'])){
    $earliest_reference_date=getFormattedDate($_GET['earliest_reference_date']);
}

if(isset($_GET['agingCSVFileName'])){
    $agingCSVFileName=$_GET['agingCSVFileName'];
}

function getFormattedDate($date){
    $date = new DateTime($date);
    return $date->format('Y-m-d');
}

spl_autoload_register(function($class){
	include_once '../Objects/'.$class.'.php';
});

$agingTable= new AgingTable($facilityId,$latest_reference_date,$earliest_reference_date);
$agingTableId=$agingTable->loadTable();

$agingSpreadsheet= new AgingSpreadsheet($agingTableId,$facilityId,$latest_reference_date,$earliest_reference_date,$agingCSVFileName);


$info=$agingSpreadsheet->loadTables();
$agingTable->insertNumberOfRows($info[0],info[1],$agingTableId);
?>