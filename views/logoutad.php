<?php
    session_start();
    session_destroy();
    unset($_SESSION['account_admin']);
    header('Location: ./admin.php'); 
?>