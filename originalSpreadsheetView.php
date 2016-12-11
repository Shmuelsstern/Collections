<?php

spl_autoload_register(function($class){
	include_once 'Objects/'.$class.'.php';
});

/* redid into class AgingSpreadsheet1
function getAllBalancesInfo($agingTableId){
	$AllMonthlyBalancesQuery = new Query("SELECT monthly_balance_id,responsible_payer_id,monthly_balance,month_from_2000,is_worked_on from monthly_aging_balances where aging_table_id = $agingTableId");
	return $AllMonthlyBalancesQuery->getResultsArrayArray();
}

function getAgingInfo($agingTableId){
	$AgingInfoQuery= new Query("SELECT * from aging_table where aging_id = $agingTableId");
	$agingInfo=$AgingInfoQuery->getArrayofResults();
	return $agingInfo;
}

function convertDateToMonthFrom2000($date){
	$month=date('n',strtotime($date));
	$year=date('y',strtotime($date));
	$monthFrom2000= $year*12+$month;
	return $monthFrom2000;
}

function getSpreadsheetArray($agingTableId){
	$agingInfo=getAgingInfo($agingTableId);
	#$rowsInAging=$agingInfo['rows_in_aging'];
	$baseResponsiblePayerId=$agingInfo['highest_index_responsible_payer']-($agingInfo['rows_in_aging']);
	$allBalancesInfo=getAllBalancesInfo($agingTableId);
	$spreadsheetArray=[];
	$LatestReferenceDateAsMonthFrom2000=convertDateToMonthFrom2000($agingInfo['latest_reference_date']);
	foreach($allBalancesInfo as $balanceInfo){
		$spreadsheetArray[($balanceInfo['responsible_payer_id']-$baseResponsiblePayerId)][$LatestReferenceDateAsMonthFrom2000-$balanceInfo['month_from_2000']]=$balanceInfo['monthly_balance'];
	}
	
	return $spreadsheetArray;
}
?>

<?php

function setSpreadsheetTable($agingTableId){
	$spreadsheetArray=getSpreadsheetArray($agingTableId);
	for($i=0;$i<615;$i++){
		echo '<tr>';
		for($k=1;$k<19;$k++){
			if(isset($spreadsheetArray[$i][$k])){
				echo "<td>{$spreadsheetArray[$i][$k]}</td>";
			}else{
				echo "<td></td>";
			}
		}
		echo '</tr>';
	}
}*/

$ourSpreadsheet=new AgingSpreadsheet1(1);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>collections</title>
<script src='/jquery-3.1.1.min.js'></script>
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style>
	.table>tbody>tr>td{
		font-size: 11px;
		max-width:10em;
		padding:3px;
		text-align:center;
		vertical-align:middle;
		line-height:11px;
		white-space: nowrap;
		overflow-x: hidden;
		text-overflow: ellipsis;
	}
	.table>tbody>tr>td:hover{
		white-space: normal;
		overflow-x: visible;
	}
</style>
</head>

<body>
	<table class="table table-bordered table-condensed ">
		<thead>
		<?php $ourSpreadsheet->getSpreadsheetHead();?>
		</thead>
		<tbody>
	<?php  $ourSpreadsheet->getSpreadsheetView();?>
		</tbody>
	</table>

	
  </body>
</html>


