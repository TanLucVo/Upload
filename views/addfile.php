<?php
require_once '../function.php';
require_once '../config.php';
session_start();
$limit = getLimit($conn);
$maxDataUser = $limit[0];
$maxfileupload = $limit[1];
$maxDataFile = $limit[2];
$notAcept = $limit[3];

$notAcept = explode(" ", $notAcept);  

try {
    $status = "";
    if (!isset($_FILES['fileToUpload']) || !isset($_POST['path']) || !isset($_POST['totalSize'])) {
        die(json_encode("No files selected"));
    }
    $upload_dir = 'uploads' . DIRECTORY_SEPARATOR;
    $not_allowed_types = $notAcept;
    $totalSize = (int) $_POST['totalSize'];
    // Define maxsize for files i.e 1gB 
    $maxsize = $maxDataFile;
    // Checks if user sent an empty form  
    if(count($_FILES['fileToUpload']['name']) > $maxfileupload){
        die(json_encode("over number uploadfile max"));
    }
    if (!empty(array_filter($_FILES['fileToUpload']['name']))) {
        
        // Loop through each file in files[] array 
        foreach ($_FILES['fileToUpload']['tmp_name'] as $key => $value) {

            $file_tmpname = $_FILES['fileToUpload']['tmp_name'][$key];
            $file_name = $_FILES['fileToUpload']['name'][$key];
            $file_size = $_FILES['fileToUpload']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            // Set upload file path 
            $filepath = $_POST['path'];
            $filepath = $filepath . basename($_FILES['fileToUpload']['name'][$key]);
            if (file_exists($filepath)){
                $status= $status."{$file_name} exist <br>";
                continue;
            }
            // Check file type is allowed or not 
            if (!in_array(strtolower($file_ext), $not_allowed_types)) {

                // Verify file size - 2MB max  
                if ($file_size > $maxsize){
                    $status = $status . "Error: File size is larger than the allowed limit. <br>";
                }
                    
                else if (move_uploaded_file($file_tmpname, $filepath)) {
                    $status = $status . "{$file_name} successfully uploaded <br>";
                    if($totalSize + $file_size > $maxsize){
                        die(json_encode("Used all data"));
                    }
                    addFile($filepath, $_SESSION['user'], $conn);
                } else {
                    $status = $status . "Error uploading {$file_name} <br>";
                    
                }
                
            } else {

                // If file extention not valid 
                $status = $status . "Error uploading {$file_name} ";
                $status = $status . "({$file_ext} file type is not allowed)<br>";
                
            }
        }
    } else {

        // If no files selected 
        $status = $status . "No files selected. <br>";
       
    }
    echo json_encode($status);
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
}
?>
