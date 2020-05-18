<?php
session_start();
if(isset($_SESSION['folderPathDownload']) &&isset($_SESSION['folderNameDownload'])){
    $path = $_SESSION['folderPathDownload'];
    $name = $_SESSION['folderNameDownload'];
}
else if (!isset($_POST['path']) || !isset($_POST['name'] )){
    die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
}else{
    $path = $_POST['path'];
    $name = $_POST['name'];
}


try {
    $dir = 'dir';
    $zip_file = $name.'.zip';

    // Get real path for our folder
    $rootPath = $path;

    // Initialize archive object
    $zip = new ZipArchive();
    $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Create recursive directory iterator
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        // Skip directories (they would be added automatically)
        if (!$file->isDir()) {
            // Get real and relative path for current file
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            // Add current file to archive
            $zip->addFile($filePath, $relativePath);
        }
    }

    // Zip archive will be created only after closing object
    $zip->close();


    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($zip_file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($zip_file));

    


     
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
}
