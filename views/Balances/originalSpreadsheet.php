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
<div class='container'>
    <div class='row'>
        <div class='col-sm-3'>
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#">Grouped</a></li>
                <li role="presentation"><a href="index.php?controller=Balances&action=individualMonths&agingID=<?php echo $this->viewmodel['agingTableId'];?>">Individual</a></li>
            </ul>
        </div>
        <div class='col-sm-6'>
            <h4 class='text-center'><strong><?php echo $this->viewmodel['agingInfo']['aging_name'];?></strong></h4>
        </div>
    </div>

</ul>
<table class="table table-bordered table-condensed ">
<!--tableheader-->
    
    <thead>
        <tr>
<?php $keys=array_keys($this->viewmodel['responsiblePayersInfo'][0]);
      foreach($keys as $key){
            if(gettype($key)!=='integer'){?>
            <th class='text-center'><?= $key;?></th>
            <?php }
        }
        for($i=0;$i<$this->viewmodel['numberOfMonthsInAging'];$i++){
            $monthFrom2000=$this->viewmodel['latestReferenceDateAsMonthFrom2000']-1-$i;?>
            <th><?php echo getMonth($monthFrom2000)."'".getYear($monthFrom2000);?></th>
        <?php } ?>
        </tr>
    </thead>
    <tbody>
<!--table-->
<?php   for($i=0;$i<$this->viewmodel['agingInfo']['rows_in_aging'];$i++){ ?>
            <tr>
<?php       foreach($this->viewmodel['responsiblePayersInfo'][$i] as $key=>$field){?>
                <td class='<?php echo str_replace(' ', '', $key)."Td ".preg_replace('/[ ,()&]/','',$field);?>'><?php echo $field; ?></td>
<?php       }
            for($k=1;$k<=$this->viewmodel['numberOfMonthsInAging'];$k++){
                if(isset($this->viewmodel['spreadsheetArray'][$i][$k])){?>
                    <td class="text-right balanceColumn"><?php echo '<span class="dollarSign">$</span>'.$this->viewmodel['spreadsheetArray'][$i][$k];?></td>
 <?php          }else{ ?>
                    <td></td>
<?php           }
            } ?>
            </tr>
<?php   } ?>
    </tbody>
</table>
</div>
<?php 
include 'utils/bottom.html';
?>
<script>
        var spreadsheetArray=<?php echo json_encode($this->viewmodel['spreadsheetArray']);?>,
        responsiblePayersInfo=<?php echo json_encode($this->viewmodel['responsiblePayersInfo']);?>;
        console.log(spreadsheetArray,responsiblePayersInfo);
</script>
<script src='views/Balances/Balances.js'></script>