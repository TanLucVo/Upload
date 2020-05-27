<?php
    require_once '../function.php';
    require_once '../config.php';
    session_start();
    function custom_copy($src, $dst, $conn) {  
    
        // open the source directory 
        $dir = opendir($src);  
    
        // Make the destination directory if not exist 
        @mkdir($dst);  
    
        // Loop through the files in source directory 
        while( $file = readdir($dir) ) {  
    
            if (( $file != '.' ) && ( $file != '..' )) {  
                if ( is_dir($src . '/' . $file) )  
                {  
    
                    // Recursively calling custom copy function 
                    // for sub directory  
                    custom_copy($src . '/' . $file, $dst . '/' . $file,$conn);  
    
                }  
                else {  
                    copy($src . '/' . $file, $dst . '/' . $file);
                    addFile($dst . '/' . $file,$_SESSION['user'],$conn);
                }  
            }  
        }  
    
        closedir($dir); 
    }  
  
    if (!isset($_SESSION['user'])) {
        header('Location: ./views/login.php');
    }
    $user= $_SESSION['user'];
    if (isset($_POST["path"]) && isset($_POST["name"])) {
        $name = $_POST["name"];
        //lấy thông tin từ các form bằng phương thức POST
        $link = $_POST["path"];
        $newpath = 'C:/xampp/htdocs/BuffaloDrive/Upload/files/'. $user.'/'.$name;
        if(!is_dir($link)){
            if (copy($link, $newpath)) {
                addFile($newpath, $user, $conn);
                echo json_encode(array('status' => true, 'data' => 'Shared'));
            } else {
                echo json_encode(array('status' => false, 'data' => "Can't share 123"));
            }
        }else{
            custom_copy($link, $newpath, $conn);
            addFile($newpath, $user, $conn);
            echo json_encode(array('status' => true, 'data' => 'Shared'));
        }  
        
        
    }
    else{
        echo json_encode(array('status' => false, 'data' => 'Parameters not valid'));
    }
