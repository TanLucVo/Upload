<?php
    require_once '../function.php';
    require_once '../config.php';
    session_start();
    try {
        if (!isset($_FILES['fileToUpload']) || !isset($_POST['path'])) {
            die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
        }
        $target_Path = $_POST['path'];
        $target_Path = $target_Path . basename($_FILES['fileToUpload']['name']);
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_Path)) {
            echo json_encode(array('status' => true, 'data' => 'upload success'));
            addFile($target_Path, $_SESSION['user'], $conn);
        } else {
            echo json_encode(array('status' => true, 'data' => "Can't upload"));
        }
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
    
?>
