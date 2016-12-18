<?php
if (!isset($_SESSION['user']) || empty($_SESSION['user'])){
    header('Location: index.php?');
}
?>