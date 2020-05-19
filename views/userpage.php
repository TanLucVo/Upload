<hr>
<h3>File</h3>
<hr>
<h4>Folader</h4>
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
        if (!$isDir) {
            continue;
        }

    ?>
        <div class="folder col-sm-6 col-md-4 col-lg-3 col-xl-2 d-flex align-items-center">
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
        if ($isDir) {
            continue;
        }
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $time = date('d/m/yy', filemtime($path));
        $size = '-';
        $dirLink = str_replace($root, '', $path);
        $dirLink = substr($dirLink, 1);

        $dirLink = $dir_path . '/' . $file;
        $dirLink = str_replace('C:/xampp/htdocs/', 'http://localhost:8888/', $dirLink);



        $size = filesize($path);
        $totalSize+= $size;
        if ($size > 1000000) {
            $size = round($size / 1000000.0, 1) . ' MB';
        } else if ($size > 1000) {
            $size = round($size / 1000.0, 1) . ' KB';
        } else {
            $size = $size . ' Bytes';
        }

        if ($ext == 'html') {
            $type = 'HTML Document';
            $icon = './Content/Images/text-x-tex-icon.png';
        } else if ($ext == 'gif') {
            $type = 'Dynamic Image';
            $icon = './Content/Images/document-compress-icon.png';
        } else if ($ext == 'png') {
            $type = 'PNG Image';
            $icon = './Content/Images/mp4-icon.png';
        } else {
            $type = 'Unknown File';
            $icon = './Content/Images/document-compress-icon.png';
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


