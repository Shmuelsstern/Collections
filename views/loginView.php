<?php 
include 'utils/top.php';
?>

<div class='vertical-center'>
    <div class='container'>
        <div class="row col-sm-6 col-sm-offset-3">
            <div class='well'>
                <div class="row">
                    <img class="img-responsive center-block padding" src='images/RESULTS2.png'/ alt='RESULTS'>
                </div>
                <form method="post" action="Models/loginVerifyModel.php?page=loginVerify" class="form-horizontal">
                <div class="form-group">
                    <label for="userName" class="col-sm-4 control-label">User name:</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="userName" placeholder="User name" name="userName">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-4 control-label">Password:</label>
                    <div class="col-sm-8">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-10">
                    <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include 'utils/bottom.html';
?>