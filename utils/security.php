<?php

if(get_class($this)!=='Login'){
    if (!isset($_SESSION['user']) || empty($_SESSION['user'])){
        header('Location: index.php?controller=Login&action=displayLogin');
        
    }
}
?>