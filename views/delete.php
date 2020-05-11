<?php
    function delete_directory($dirname) {
        if (is_dir($dirname))
          $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                        unlink($dirname."/".$file);
                else
                        delete_directory($dirname.'/'.$file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
if (!isset($_POST['name']) || !isset($_POST['path'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }
    
    $name = $_POST['name'];
    $path = $_POST['path'];

    try{
        if(delete_directory($path.'/'.$name)){
            echo json_encode(array('status' => true, 'data' => 'delete success'));
        }else{  
            echo json_encode(array('status' => true, 'data' => "Can't delete"));
        }
       
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }

?>