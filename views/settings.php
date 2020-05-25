<?php

require_once '../function.php';
require_once '../config.php';

session_start();

if (isset($_POST['data']) && isset($_POST['numfile']) && isset($_POST['filedata']) && isset($_POST['typeNotAceppt'])) {
    if($_POST['data']=='' || $_POST['numfile'] == '' || $_POST['filedata'] == '' || $_POST['typeNotAceppt'] == ''){
        echo json_encode('Parameters not valid');
        return;
    }
    $data = $_POST['data'];
    $numfile = $_POST['numfile'];
    $filedata = $_POST['filedata'];
    $typeNotAceppt = $_POST['typeNotAceppt'];
    addSettings($data, $numfile, $filedata, $typeNotAceppt, $conn);
    echo json_encode("Settings Changed");
} else {
    echo json_encode('Parameters not valid');
}
