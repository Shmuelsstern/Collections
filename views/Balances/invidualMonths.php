<?php

function getMonth($monthFrom2000){
    $mons = explode(" ","Dec Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov ");
    return $mons[$monthFrom2000%12];
}

function getYear($monthFrom2000){
    return floor($monthFrom2000/12);
}

include 'utils/top.php';
?>
<table class="table table-bordered table-condensed ">
    <thead>
        <tr><th>Payer Type</th><th>Payer</th><th>Name</th><th>Date</th><th>Balance</th><th>Current Status</th></tr>
    </thead>



</table>