<?php
    if (isset($usershare)) {
        if($name != $usershare){
            $isShare = true;
        }
        else{
            $isShare = false;
        }
    }
    else{
        $isShare = false;
    }
    
?>
<hr>
<h3>My Drive</h3>
<hr>
<h4>Folder</h4>
<div class="row">
    <?php
    foreach ($files as $file) {
        if (substr($file, 0, 1) === '.') {
            continue;
        }
        $path = $dir_path . '/' . $file;
        $isDir = is_dir($path);
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $time = date('d/m/yy', filemtime($path));
        $size = '-';
        $dirLink = str_replace($root, '', $path);
        $dirLink = substr($dirLink, 1);
        $dirLink = "?dir=$dirLink";
        $type = 'Directory';
        if($isShare && in_array($dir_path.'/'.$file, $allLink) != 1){
            continue;
        }
        if (!$isDir) {
            continue;
        }


    ?>
        <div class="folder col-8 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-flex align-items-center">
            <svg x="0px" y="0px" focusable="false" viewBox="0 0 24 24" height="24px" width="24px" fill="#5f6368">
                <g>
                    <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"></path>
                    <path d="M0 0h24v24H0z" fill="none"></path>
                </g>
            </svg>
            <p><a href="<?= $dirLink ?>" class="linkfile"><?= $file ?></a></p>
            <input type="hidden" name="asd" value="<?= $dir_path ?>">
        </div>
    <?php

    }
    ?>

</div>
<hr>
<h4>File</h4>
<div class="row">
    <?php
    $totalSize=0;
    foreach ($files as $file) {
        if (substr($file, 0, 1) === '.') {
            continue;
        }
        $path = $dir_path . '/' . $file;
        $isDir = is_dir($path);
        if($isShare && in_array($dir_path.'/'.$file, $allLink) != 1){
            continue;
        }
        if ($isDir) {
            continue;
        }
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $time = date('d/m/yy', filemtime($path));
        $size = '-';
        $dirLink = str_replace($root, '', $path);
        $dirLink = substr($dirLink, 1);

        $dirLink = $dir_path . '/' . $file;
        $dirLink = str_replace('C:/xampp/htdocs/', 'http://' . $_SERVER['HTTP_HOST'] . '/', $dirLink);



        $size = filesize($path);
        $totalSize+= $size;
        if ($size > 1000000) {
            $size = round($size / 1000000.0, 1) . ' MB';
        } else if ($size > 1000) {
            $size = round($size / 1000.0, 1) . ' KB';
        } else {
            $size = $size . ' Bytes';
        }

        switch (strtolower($ext)) {
            case 'apk':
                $type = 'apk';
                $icon = './Content/Images/iconfile/apk.png';
                break;
            case 'app':
                $type = 'app';
                $icon = './Content/Images/iconfile/app.png';
                break;
            case 'css':
                $type = 'css';
                $icon = './Content/Images/iconfile/css.png';
                break;
            case 'dll':
                $type = 'dll';
                $icon = './Content/Images/iconfile/dll.png';
                break;
            case 'doc':
                $type = 'doc';
                $icon = './Content/Images/iconfile/doc.png';
                break;
            case 'docx':
                $type = 'docx';
                $icon = './Content/Images/iconfile/docx.png';
                break;
            case 'exe':
                $type = 'exe';
                $icon = './Content/Images/iconfile/exe.png';
                break;
            case 'gif':
                $type = 'gif';
                $icon = './Content/Images/iconfile/gif.png';
                break;
            case 'html':
                $type = 'html';
                $icon = './Content/Images/iconfile/html.png';
                break;
            case 'jpg':
                $type = 'jpg';
                $icon = './Content/Images/iconfile/jpg.png';
                break;
            case 'js':
                $type = 'js';
                $icon = './Content/Images/iconfile/js.png';
                break;
            case 'log':
                $type = 'log';
                $icon = './Content/Images/iconfile/log.png';
                break;
            case 'mp3':
                $type = 'mp3';
                $icon = './Content/Images/iconfile/mp3.png';
                break;
            case 'mp4':
                $type = 'mp4';
                $icon = './Content/Images/iconfile/mp4.png';
                break;
            case 'pdf':
                $type = 'pdf';
                $icon = './Content/Images/iconfile/pdf.png';
                break;
            case 'png':
                $type = 'png';
                $icon = './Content/Images/iconfile/png.png';
                break;
            case 'ppt':
                $type = 'ppt';
                $icon = './Content/Images/iconfile/ppt.png';
                break;
            case 'php':
                $type = 'php';
                $icon = './Content/Images/iconfile/php.png';
                break;
            case 'rar':
                $type = 'rar';
                $icon = './Content/Images/iconfile/rar.png';
                break;
            case 'sql':
                $type = 'sql';
                $icon = './Content/Images/iconfile/sql.png';
                break;
            case 'txt':
                $type = 'txt';
                $icon = './Content/Images/iconfile/txt.png';
                break;
            case 'zip':
                $type = 'zip';
                $icon = './Content/Images/iconfile/zip.png';
                break;
            default:
                $type = 'undefined';
                $icon = './Content/Images/iconfile/default.png';
                break;
        }
    ?>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 file-item">
            <div class="card" style="width: 8rem;">
                <img class="card-img-top" src=<?= $icon ?> alt="Card image cap">
                <div class="card-body p-1">
                    <p class="card-title card-text mb-0 text-center"><a href="<?= $dirLink ?>"><?= $file ?></a></p>
                    <p class="card-text text-center"><small class="text-muted">Last updated <?= $time ?></small></p>
                </div>
                <input type="hidden" name="linkfile" value="<?= $dir_path.'/'.$file ?>">
            </div>
        </div>
    <?php
    }
    ?>
</div>


