<?php
// require_once '../function.php';
// require_once '../config.php';
// session_start();
// try {
//     if (!isset($_FILES['fileToUpload']) || !isset($_POST['path'])) {
//         die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
//     }
//     $target_Path = $_POST['path'];
//     $target_Path = $target_Path . basename($_FILES['fileToUpload']['name']);
//     if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_Path)) {
//         echo json_encode(array('status' => true, 'data' => 'upload success'));
//         addFile($target_Path, $_SESSION['user'], $conn);
//     } else {
//         echo json_encode(array('status' => true, 'data' => "Can't upload"));
//     }
// } catch (PDOException $ex) {
//     die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
// }
if (isset($_POST['submit'])) {

    // Configure upload directory and allowed file types 
    $upload_dir = 'uploads' . DIRECTORY_SEPARATOR;
    $allowed_types = array('py');

    // Define maxsize for files i.e 2MB 
    $maxsize = 2 * 1024 * 1024;
    // Checks if user sent an empty form  
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

            // Check file type is allowed or not 
            if (!in_array(strtolower($file_ext), $allowed_types)) {

                // Verify file size - 2MB max  
                if ($file_size > $maxsize)
                    echo "Error: File size is larger than the allowed limit.";
                if (move_uploaded_file($file_tmpname, $filepath)) {
                    echo "{$file_name} successfully uploaded <br />";
                } else {
                    echo "Error uploading {$file_name} <br />";
                }
            } else {

                // If file extention not valid 
                echo "Error uploading {$file_name} ";
                echo "({$file_ext} file type is not allowed)<br / >";
            }
        }
    } else {

        // If no files selected 
        echo "No files selected.";
    }
}  
?> 
