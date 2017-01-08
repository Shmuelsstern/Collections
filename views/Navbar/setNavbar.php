<?php

function getUserName($navController){
  return $navController->viewmodel['username'];
}

?>
<nav class='navbar navbar-default'>
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img class="img-responsive" src="images/RESULTS3.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php?controller=balances&action=originalSpreadsheet">Balances<span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Balances <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php foreach($viewmodel['agingListArrays'] as $agingListArray){ ?>
            <li><a href="index.php?controller=balances&action=originalSpreadsheet&agingID=<?php echo $agingListArray['aging_id'];?>"><span class='agingLink' ><?=$agingListArray['aging_name'];?></span></a></li>

          <?php } ?> 
            
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span id="sessionFacility"><?=$_SESSION['facility']?></span><span  class="caret"></span></a>
          <ul class="dropdown-menu">
          <?php foreach($viewmodel['facilities'] as $facility){ ?> 
            <li><a href="index.php?controller=Navbar&action=setSessionFacility&facility=<?php echo $facility;?>"><span class='facilityLink' ><?=$facility;?></span></a></li>

          <?php } ?> 
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        <li><p class='navbar-text'><?php echo getUserName($this);?></p></li>
        <li>
          <a href="index.php?controller=Login&action=logoff"><span class='glyphicon glyphicon-off'></span> </a>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
