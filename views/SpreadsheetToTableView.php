<?php

spl_autoload_register(function($class){
	include_once 'Objects/'.$class.'.php';
});

function getFacilities(){
    $faciltyQuery= new query('SELECT facility_id,facility_name FROM collections.facilities');
    $results=$faciltyQuery->getResultsArrayArray();
    return $results;
}
function getFacilitiesOptions(){
    $options='';
    $facilities=getFacilities();
    foreach($facilities as $facility){
        $options.="<option value ={$facility['facility_id']}>{$facility['facility_name']}</option>";
    }
    return $options;
}



?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>spreadsheet to tables</title>
</head>
<body>
    <form action='Models/SpreadsheetToTableModel.php'>
        <label for="facility">select facility
            <select name="facility">
                <?php echo getFacilitiesOptions(); ?>
            </select>
        </label>
        <br/>
        <label for="latest_reference_date">Choose the date after the most recent set of balances
            <input type="date" name="latest_reference_date">
        </label>
        <br/>
        <label for="earliest_reference_date">Choose the date of the first of the month of the earliest set of balances(not prior)
            <input type="date" name="earliest_reference_date">
        </label>
        <br/>
        <label for="CSVFilePath">Please choose the CSV file containing the file you want to load into tables
            <input type="file" name="agingCSVFileName">
        </label>
        <br/>
        <input type="submit">
    </form>
	
</body>
</html>