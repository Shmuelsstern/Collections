<?php

$latest_reference_date='2016-04-01';
$time=strtotime("-1 month $latest_reference_date");
while ($time>strtotime('2014-10-01')){
$time=strtotime("-1 month $date");
echo $time.' ';
$date=date("Y-m-d",$time);
echo $date.'<br>';
}
?>