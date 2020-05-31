<?php
require_once './function.php';
require_once './config.php';
session_start();

// Creating a variable with an URL 
// to be checked 

$path123 = ($_SERVER['REQUEST_URI']);
if (strpos($path123, '?dir=')) {
    $userpagelink = substr($path123, strpos($path123, '?') + 5, strlen($path123));
    $_SESSION['userpagelink'] = $userpagelink;
}

if (!isset($_SESSION['account_admin'])) {
    header('Location: ./views/admin.php');
} else {
    $user = $_SESSION['account_admin'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Buffalo Drive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="./Content/Scripts/main.js"></script>
    <link rel="stylesheet" href="./Content/Styles/main.css">
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light sticky-top" id="navbar">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div>
            <a href="./adminpage.php"><img src="./Content/Images/logo.png" alt="Buffalo Drive" class="navbar-brand" width=70px></a>
            <a class="navbar-brand" href="./adminpage.php">Buffalo Drive</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <form class="form-inline my-2 my-lg-0 search">
                <input class="form-control mr-auto p-3 mr-mb-0" type="search" placeholder="Search" aria-label="Search">
            </form>
            <div class="infor d-flex flex-row bd-highlight mb-3">
                <a href="./views/logoutad.php">Logout</a>
            </div>
        </div>
    </nav>
    <?php
    $root = $_SERVER['DOCUMENT_ROOT'] . "/BuffaloDrive/Upload/files";
    // echo $_SERVER['HTTP_HOST'];
    $dirName = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING);
    $create = filter_input(INPUT_POST, 'create', FILTER_SANITIZE_STRING);
    $folder = filter_input(INPUT_POST, 'folderName', FILTER_SANITIZE_STRING);
    $url = $_SERVER['REQUEST_URI'];
    $back = 'http://' . $_SERVER['HTTP_HOST'] . '' . substr($url, 0, strrpos($url, '/'));
    if ($dirName) {
        $dir_path = $root . '/' . $dirName;
    } else {
        $dir_path = $root;
    }
    $mess = '';
    if (!file_exists($root) && $user != "admin") {
        mkdir($root);
    }
    $files = scandir($dir_path);
    ?>
    <div>
        <div class="row">
            <div class="sticky col-6 col-lg-3 col-sm-5 left" id="left">
                <div class="my-drive d-flex">
                    <svg class="" width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false">
                        <path d="M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H5v-1h14v1zm0-3H5V4h14v13zm-9.35-2h5.83l1.39-2.77h-5.81zm7.22-3.47L13.65 6h-2.9L14 11.53zm-5.26-2.04l-1.45-2.52-3.03 5.51L8.6 15z"></path>
                    </svg>
                    <a class="d-inline" href="./adminpage.php">Account</a>
                </div>
                <hr>
                <div class="settings-user d-flex">
                    <svg class="" width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false">
                        <path d="M13.85 22.25h-3.7c-.74 0-1.36-.54-1.45-1.27l-.27-1.89c-.27-.14-.53-.29-.79-.46l-1.8.72c-.7.26-1.47-.03-1.81-.65L2.2 15.53c-.35-.66-.2-1.44.36-1.88l1.53-1.19c-.01-.15-.02-.3-.02-.46 0-.15.01-.31.02-.46l-1.52-1.19c-.59-.45-.74-1.26-.37-1.88l1.85-3.19c.34-.62 1.11-.9 1.79-.63l1.81.73c.26-.17.52-.32.78-.46l.27-1.91c.09-.7.71-1.25 1.44-1.25h3.7c.74 0 1.36.54 1.45 1.27l.27 1.89c.27.14.53.29.79.46l1.8-.72c.71-.26 1.48.03 1.82.65l1.84 3.18c.36.66.2 1.44-.36 1.88l-1.52 1.19c.01.15.02.3.02.46s-.01.31-.02.46l1.52 1.19c.56.45.72 1.23.37 1.86l-1.86 3.22c-.34.62-1.11.9-1.8.63l-1.8-.72c-.26.17-.52.32-.78.46l-.27 1.91c-.1.68-.72 1.22-1.46 1.22zm-3.23-2h2.76l.37-2.55.53-.22c.44-.18.88-.44 1.34-.78l.45-.34 2.38.96 1.38-2.4-2.03-1.58.07-.56c.03-.26.06-.51.06-.78s-.03-.53-.06-.78l-.07-.56 2.03-1.58-1.39-2.4-2.39.96-.45-.35c-.42-.32-.87-.58-1.33-.77l-.52-.22-.37-2.55h-2.76l-.37 2.55-.53.21c-.44.19-.88.44-1.34.79l-.45.33-2.38-.95-1.39 2.39 2.03 1.58-.07.56a7 7 0 0 0-.06.79c0 .26.02.53.06.78l.07.56-2.03 1.58 1.38 2.4 2.39-.96.45.35c.43.33.86.58 1.33.77l.53.22.38 2.55z"></path>
                        <circle cx="12" cy="12" r="3.5"></circle>
                    </svg>
                    <a class="d-inline" style="cursor:pointer" id='settings-btn'>Setting</a>
                </div>
            </div>
            <div class="col-6 col-lg-9 col-sm-7 right" id="right">
                <?php
                if (isset($usershare)) {
                    if ($name != $usershare) {
                        $isShare = true;
                    } else {
                        $isShare = false;
                    }
                } else {
                    $isShare = false;
                }

                ?>
                <hr>
                <h3>Manager Account</h3>
                <hr>
                <h4>Account</h4>
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
                        if ($isShare && in_array($dir_path . '/' . $file, $allLink) != 1) {
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
                    $totalSize = 0;
                    foreach ($files as $file) {
                        if (substr($file, 0, 1) === '.') {
                            continue;
                        }
                        $path = $dir_path . '/' . $file;
                        $isDir = is_dir($path);
                        if ($isShare && in_array($dir_path . '/' . $file, $allLink) != 1) {
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
                        $totalSize += $size;
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
                                <input type="hidden" name="linkfile" value="<?= $dir_path . '/' . $file ?>">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>



            </div>
        </div>
    </div>
    <ul class='custom-menu'>
        <li class="delete" data-action="Delete">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false" class="undefined">
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13z"></path>
                <path d="M9 8h2v9H9zm4 0h2v9h-2z"></path>
            </svg>
            Delete Account
        </li>
        <li class="rename" data-action="Rename">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false" class="undefined">
                <path d="M1,15.25V19h3.75L15.814,7.936l-3.75-3.75L1,15.25z M18.707,5.043c0.391-0.391,0.391-1.023,0-1.414l-2.336-2.336  c-0.391-0.391-1.024-0.391-1.414,0l-1.832,1.832l3.75,3.75L18.707,5.043z"></path>
            </svg>
            Rename Account
        </li>
        <li class="download" data-action="Download">
            <a href="#">
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false" class="undefined">
                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"></path>
                </svg>
                Download
            </a>
        </li>
    </ul>
    <!-- Rename dialog -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Rename</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <p>Enter a new name.</p>
                    <input type="text" id="newname">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id='save'">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class=" modal fade" id="setting-modal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Settings</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>
                                <form method="post" id='setting-form'>
                                    <div class="modal-body ">
                                        <p class="mb-1">Enter total data each user.</p>
                                        <input type="text" class='form-control' placeholder="Bytes" id="totalData">
                                        <p class="mb-1">Enter number of file in upload.</p>
                                        <input type="text" class='form-control' placeholder="Number" id="numFile">
                                        <p class="mb-1">Enter maximum data of file.</p>
                                        <input type="text" class='form-control' placeholder="Bytes" id="filedata">
                                        <p class="mb-1">Enter file extension not accept (separated by spaces).</p>
                                        <input type="text" class='form-control' placeholder="Text" id="typeNotAccept">
                                    </div>
                                    <div class="modal-footer">
                                        <p class="message"></p>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <input class='btn btn-success' type="submit" value="Save" name="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                <!-- Delete dialog -->
                <div class=" modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Delete</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success" data-dismiss="modal" id='delete'>Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add file dialog -->
                <div class="modal fade" id="addFile" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title">New File</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" id="uploadFile">
                                    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
                                    <input type="hidden" name="path" value="<?= $dir_path . '/' ?>" id='pathfile'>
                                    <p>Drag your files here or click in this area.</p>
                                    <div class="progress mt-3">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                    <p id="status"></p>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <input class='btn btn-success' type="submit" value="Upload" name="submit">
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add folder dialog -->
                <div class="modal fade" id="addFolder" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title">New Folder</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form method="post" id='newFolderForm'>
                                <div class="modal-body">
                                    <input type="text" name="folderName" id='folderName'>
                                    <input type="hidden" name="folderPath" value="<?= $dir_path ?>" id='folderPath'>

                                </div>
                                <div class="modal-footer">
                                    <p class="message"></p>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <input class="btn btn-success" type="submit" value="New folder" name="create">

                                    <br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
</body>

</html>