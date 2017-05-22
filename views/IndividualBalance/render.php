<?php
//echo json_encode($viewmodel);


include 'utils/top.php';

?>
<div class='container'>
    <div class='row'>
         <div class='col-sm-4'>
<?php echo $viewmodel['facility']->renderInWell();
      echo $viewmodel['patient']->renderInWell();
?>
        </div>
        <div class='col-sm-8'>
            <div class='well'>
                <div class='row'> 
<?php echo $viewmodel['responsiblePayer']->render();
      echo $viewmodel['monthlyBalance']->render();
?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include 'utils/bottom.html';
?>