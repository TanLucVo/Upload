<?php
function copyDir($src, $user) {
    $namedirfile = substr($src, -(strlen($src) - strrpos($src, '/') - 1) , strlen($src) - strrpos($src, '/'));
    $usertrash = $_SERVER['DOCUMENT_ROOT'] . "/BuffaloDrive/Upload/files/trash/" . $user;
    $dest = $usertrash . '/' . $namedirfile;
    if (!file_exists($usertrash)) {
        mkdir($usertrash);
    }
    if (!file_exists($dest)) {
        mkdir($dest);
    }
    foreach (scandir($src) as $file) { 
        $srcfile = rtrim($src, '/') .'/'. $file; $destfile = rtrim($dest, '/') .'/'. $file; 
        if (!is_readable($srcfile)) { 
            continue; 
        } 
        if ($file != '.' && $file != '..') { 
            if (is_dir($srcfile)) { 
                if (!file_exists($destfile)) { 
                    mkdir($destfile); 
                } 
                copyDir($srcfile, $destfile); 
            } 
            else { 
                copy($srcfile, $destfile); 
            } 
        } 
    } 
}
?>