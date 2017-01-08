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
<!--tableheader-->
    <h4 class='text-center'><strong><?php echo $this->viewmodel['agingInfo']['aging_name'];?></strong></h4>
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
<!--table-->
<?php   for($i=0;$i<$this->viewmodel['agingInfo']['rows_in_aging'];$i++){ ?>
            <tr>
<?php       for($k=1;$k<4;$k++){?>
                <td><?php echo "{$this->viewmodel['responsiblePayersInfo'][$i][$k-1]}"; ?></td>
<?php       }
            for(;$k<=$this->viewmodel['numberOfMonthsInAging']+3;$k++){
                if(isset($this->viewmodel['spreadsheetArray'][$i][$k])){?>
                    <td><?php echo "{$this->viewmodel['spreadsheetArray'][$i][$k]}"; ?></td>
 <?php          }else{ ?>
                    <td></td>
<?php           }
            } ?>
            </tr>
<?php   } ?>
</table>
 
<?php 
include 'utils/bottom.html';

?>