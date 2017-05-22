<?php

function getMonth($monthFrom2000){
    $mons = explode(" ","Dec Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov");
    return $mons[$monthFrom2000%12];
}

function getYear($monthFrom2000){
    return floor($monthFrom2000/12);
}

include 'utils/top.php';
?>
<div class='container spreadsheetView'>
    <div class='row'>
        <div class='col-sm-3'>
            <ul class="nav nav-tabs">
                <li id='groupedTab' role="presentation" ><a href="#">Grouped</a></li>
                <li id='individualTab' role="presentation" class="active"><a href="#">Individual</a></li>
            </ul>
        </div>
        <div class='col-sm-6'>
            <h4 class='text-center'><strong><?php echo $this->viewmodel['agingInfo']['aging_name'];?></strong></h4>
        </div>
    </div>

    <div id="individualView">    
        <div class='row'>
            <div class='col-sm-9'>
                <table class="table table-bordered table-condensed table-fixed">
                    <thead>
                        <tr><th>Payer Type</th><th>Payer</th><th>Name</th><th>Date</th><th>Balance</th><th>Current Status</th></tr>
                    </thead>
                    <tbody>
                <?php for($i=0;$i<$this->viewmodel['agingInfo']['rows_in_aging'];$i++){
                            ?>
                            <tr>
                <?php       for($k=1;$k<=$this->viewmodel['numberOfMonthsInAging'];$k++){
                                    $monthFrom2000=$this->viewmodel['latestReferenceDateAsMonthFrom2000']-$k;
                                    if(isset($this->viewmodel['spreadsheetArray'][$i][$k])){ ?>
                                        <td class='PayerTypeTd <?php echo preg_replace('/[ ,()&]/','',$this->viewmodel['responsiblePayersInfo'][$i]['Payer Type']);?>'><?php echo $this->viewmodel['responsiblePayersInfo'][$i]['Payer Type'];?></td>
                                        <td class='PayerTd <?php echo preg_replace('/[ ,()&]/','',$this->viewmodel['responsiblePayersInfo'][$i]['Payer']);?>'><?php echo $this->viewmodel['responsiblePayersInfo'][$i]['Payer'];?></td>
                                        <td class='NameTd <?php echo preg_replace('/[ ,()&]/','',$this->viewmodel['responsiblePayersInfo'][$i]['Name']);?>'><?php echo $this->viewmodel['responsiblePayersInfo'][$i]['Name'];?></td>
                                        <td class="monthColumn"><?php echo getMonth($monthFrom2000)." '".getYear($monthFrom2000);?></td>
                                        <td data-monthly-balance-id=<?= $this->viewmodel['spreadsheetArray'][$i][$k]['monthlyBalanceId']?> class="text-right balanceColumn"><a href='index.php?controller=IndividualBalance&action=render&monthlyBalanceID=<?= $this->viewmodel['spreadsheetArray'][$i][$k]['monthlyBalanceId']?>'><span class="dollarSign">$</span><?= $this->viewmodel['spreadsheetArray'][$i][$k]['monthlyBalance'];?></a></td>
                                        <td></td>
                                        </tr>
                <?php               }
                            }
                    }?>  
                    </tbody>


                </table>
            </div>
        </div>
    </div>
    <div id="originalSpreadsheetView">
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
                            <td data-monthly-balance-id=<?= $this->viewmodel['spreadsheetArray'][$i][$k]['monthlyBalanceId']?> class="text-right balanceColumn"><a href='index.php?controller=IndividualBalance&action=render&monthlyBalanceID=<?= $this->viewmodel['spreadsheetArray'][$i][$k]['monthlyBalanceId']?>'><span class="dollarSign">$</span><?= $this->viewmodel['spreadsheetArray'][$i][$k]['monthlyBalance'];?></a></td>
        <?php          }else{ ?>
                            <td></td>
        <?php           }
                    } ?>
                    </tr>
        <?php   } ?>
            </tbody>
        </table>
    </div>
</div>
<?php 
include 'utils/bottom.html';
?>

<script>
        var /*spreadsheetArray=<?php echo json_encode($this->viewmodel['spreadsheetArray']);?>,
        responsiblePayersInfo=<?php echo json_encode($this->viewmodel['responsiblePayersInfo']);?>,*/
        balancesModel=<?php echo json_encode($this->viewmodel);?>;
        console.log(/*spreadsheetArray,responsiblePayersInfo,*/balancesModel);
</script>
<script src='views/Balances/Balances.js'></script>