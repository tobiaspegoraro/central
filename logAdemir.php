<?php
session_start();
if(!isset($_SESSION['an']) || $_SESSION['an'] != 1 || $_SESSION['an'] != 10){
    header("Location: ../index.php?logout=true");
    
    exit;
}
?>