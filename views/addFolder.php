<?php

    require_once '../function.php';
    require_once '../config.php';

    session_start();
    if(isset($_SESSION['userpagelink']) && $_SESSION['user']=='admin'){
        $user = $_SESSION['userpagelink'];
    }
    else{
        $user = $_SESSION['user'];
    }
    if(isset($_POST['folderName']) && isset($_POST['folderPath']))
    {
        $folder = filter_input(INPUT_POST, 'folderName', FILTER_SANITIZE_STRING);
        $dir_path = filter_input(INPUT_POST, 'folderPath', FILTER_SANITIZE_STRING);

        if (file_exists($dir_path . '/' . $folder)) {
            echo json_encode('Folder exist');
        } else {
            mkdir($dir_path . '/' . $folder);
            addFile($dir_path . '/' . $folder, $user, $conn);
            echo json_encode("Folder created");
        }
    }else{
        echo json_encode( 'Parameters not valid');
    }
