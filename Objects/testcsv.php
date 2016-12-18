<?php

			
function printCSV(){
		set_include_path("C:\Users\Shmuel\project LTC");
		$handle=fopen('Tonga aging to be put into tables.csv','r',true);
        $fields=fgetcsv($handle);
		while(!feof($handle)){
            foreach($fields as $field){
                echo $field."<br>";
            }
        $fields=fgetcsv($handle);
		}
		fclose($handle);
	}

printCSV();
?>