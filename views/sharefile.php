<?php
    require_once '../function.php';
    require_once '../config.php';
    
    if (!isset($_POST['path']) ){
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }
    $path = $_POST['path'];

    try{
        
        shareFile($path, $conn);
        echo json_encode(array('status' => true, 'data' => "Can't rename"));
    
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
