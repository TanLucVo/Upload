<?php
    require_once '../function.php';
    require_once '../config.php';
    
    if (!isset($_POST['path']) ){
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }
    $path = $_POST['path'];
    function share_directory($dirname, $conn)
    {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file)) {
                    shareFile($dirname . "/" . $file, $conn);
                } else {
                    delete_directory($dirname . '/' . $file, $conn);
                }
            }
        }
        shareFile($dirname, $conn);
        closedir($dir_handle);
        return true;
    }
    try{
        if(is_dir($path)){
            share_directory($path, $conn);
        }
        else{
            shareFile($path, $conn);
        }
        echo json_encode(array('status' => true, 'data' => "Shared"));
    
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
