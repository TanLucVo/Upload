<?php
function copyDir($src, $dest, $user) {
    
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