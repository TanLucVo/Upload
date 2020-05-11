<?php

    if (!isset($_POST['name']) || !isset($_POST['path']) || !isset($_POST['newname'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $name = $_POST['name'];
    $path = $_POST['path'];
    $newName = $_POST['newname'];

    try{
        if(rename($path.'/'.$name,$path.'/'.$newName)){
            echo json_encode(array('status' => true, 'data' => 'rename success'));
        }else{  
            echo json_encode(array('status' => true, 'data' => "Can't rename"));
        }
    
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>