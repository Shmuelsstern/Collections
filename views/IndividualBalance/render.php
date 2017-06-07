<?php
//echo json_encode($viewmodel);


include 'utils/top.php';

?>
<div class='container-fluid'>
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
<?php foreach($viewmodel['collectibles'] as $collectible){ ?>
            <div class="row">
<?php   echo $collectible->renderCollectible();?>
            </div> 
<?php   foreach($collectible->getComments() as $comment){;?>
            <div class="row">
                <div class='col-xs-12'>
<?php       echo $comment->render(); ?> 
                </div>
            </div> 
<?php   } ?>                     
            <hr/> 
<?php } ?>            
        </div>
    </div>
</div>
<?php 
include 'utils/bottom.html';
?>