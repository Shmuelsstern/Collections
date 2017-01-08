<?php 
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    echo $viewmodel;
}else{
 header('Location: index.php?controller='.$_SESSION['controller'].'&action='.$_SESSION['action']);
}

?>