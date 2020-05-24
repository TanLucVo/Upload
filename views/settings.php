<?php

require_once '../function.php';
require_once '../config.php';

session_start();

if (isset($_POST['data']) && isset($_POST['numfile']) && isset($_POST['filedata']) && isset($_POST['typeNotAceppt'])) {
    $folder = filter_input(INPUT_POST, 'folderName', FILTER_SANITIZE_STRING);
    $dir_path = filter_input(INPUT_POST, 'folderPath', FILTER_SANITIZE_STRING);
    addSettings($data, $numfile, $filedata, $typeNotAceppt, $conn);
    echo json_encode("Folder created");
} else {
    echo json_encode('Parameters not valid');
}
