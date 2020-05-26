<?php
require_once '../function.php';
require_once '../config.php';

session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['name'])) {
    header('Location: ./views/login.php');
} else {
    $user = $_SESSION['user'];
    $name = $_SESSION['name'];
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
    <script src="../Content/Scripts/main.js"></script>
    <link rel="stylesheet" href="../Content/Styles/main.css">
</head>

<body>
    
    <nav class="navbar navbar-expand-md navbar-light sticky-top" id="navbar">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div>
            <a href="../"><img src="../Content/Images/logo.png" alt="Buffalo Drive" class="navbar-brand" width=70px></a>
            <a class="navbar-brand" href="../">Buffalo Drive</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <form class="form-inline my-2 my-lg-0 search">
                <input class="form-control mr-auto p-3 mr-mb-0" type="search" placeholder="Search" aria-label="Search">
            </form>
            <div class="infor d-flex flex-row bd-highlight mb-3">
                <a href="../views/profile.php"><img src="../Content/Images/avatar.png" alt="<?= $name ?>"></a>
                <a href="../views/profile.php"><?= $name ?></a>
                <a href="../views/logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <?php
    $root = $_SERVER['DOCUMENT_ROOT'] . "/BuffaloDrive/Upload/files/trash/" . $_SESSION['user'];
    // echo $_SERVER['HTTP_HOST'];
    $dirName = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING);
    $create = filter_input(INPUT_POST, 'create', FILTER_SANITIZE_STRING);
    $folder = filter_input(INPUT_POST, 'folderName', FILTER_SANITIZE_STRING);
    $url = $_SERVER['REQUEST_URI'];
    $back = 'http://localhost:8888' . '' . substr($url, 0, strrpos($url, '/'));
    if ($dirName) {
        $dir_path = $root . '/' . $dirName;
    } else {
        $dir_path = $root;
    }
    $mess = '';
    if (!file_exists($root) && $user != 'admin') {
        mkdir($root);
    }
    $files = scandir($dir_path);
    ?>
    <div>
        <div class="row">
            <div class="sticky col-lg-3 col-sm-5 left" id="left">
                <div class="new d-flex" data-toggle="collapse" href="#multiCollapse" role="button" aria-expanded="false" aria-controls="multiCollapse">
                    <svg class="bi bi-folder-plus" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.828 4H2.19a1 1 0 00-.996 1.09l.637 7a1 1 0 00.995.91H9v1H2.826a2 2 0 01-1.991-1.819l-.637-7a1.99 1.99 0 01.342-1.31L.5 3a2 2 0 012-2h3.672a2 2 0 011.414.586l.828.828A2 2 0 009.828 3h3.982a2 2 0 011.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0013.81 4H9.828zm-2.95-1.707L7.587 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 011-.98h3.672a1 1 0 01.707.293z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M13.5 10a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13v-1.5a.5.5 0 01.5-.5z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M13 12.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd" />
                    </svg>
                    <p>New</p>
                </div>
                <div class="collapse multi-collapse" id='multiCollapse'>
                    <a class="dropdown-item" href="#" id='newfile'>New File</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" id='newfolder'>New Folder</a>
                </div>
                <div class="recent d-flex">
                    <svg class="a-s-fa-Ha-pa" width="1em" height="1em" viewBox="0 0 24 24" fill="#000000" focusable="false">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path>
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"></path>
                    </svg>
                    <a>Recent</a>
                </div>
                <div class="my-drive d-flex">
                    <svg class="" width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false">
                        <path d="M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H5v-1h14v1zm0-3H5V4h14v13zm-9.35-2h5.83l1.39-2.77h-5.81zm7.22-3.47L13.65 6h-2.9L14 11.53zm-5.26-2.04l-1.45-2.52-3.03 5.51L8.6 15z"></path>
                    </svg>
                    <a class="d-inline" href="../">My Drive</a>
                </div>
                <div class="trash d-flex">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false" class="undefined ">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13z"></path>
                        <path d="M9 8h2v9H9zm4 0h2v9h-2z"></path>
                    </svg>
                    <a href="./trash.php">Trash</a>
                </div>
                <hr>
                <div class="stored d-flex ">
                    <svg class="a-s-fa-Ha-pa" width="24px" height="24px" viewBox="0 0 24 24" focusable="false" fill="#000000">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 20h18v-4H3v4zm2-3h2v2H5v-2zM3 4v4h18V4H3zm4 3H5V5h2v2zm-4 7h18v-4H3v4zm2-3h2v2H5v-2z"></path>
                    </svg>
                    <div>
                        <p>Storage</p>
                        <p class="totalSize">0 MB used</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-sm-7 right" id="right">
                <hr>
                <h3>Trash Can</h3>
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

                        switch ($ext) {
                            case 'apk':
                                $type = 'apk';
                                $icon = '../Content/Images/iconfile/apk.png';
                                break;
                            case 'app':
                                $type = 'app';
                                $icon = '../Content/Images/iconfile/app.png';
                                break;
                            case 'css':
                                $type = 'css';
                                $icon = '../Content/Images/iconfile/css.png';
                                break;
                            case 'dll':
                                $type = 'dll';
                                $icon = '../Content/Images/iconfile/dll.png';
                                break;
                            case 'doc':
                                $type = 'doc';
                                $icon = '../Content/Images/iconfile/doc.png';
                                break;
                            case 'docx':
                                $type = 'docx';
                                $icon = '../Content/Images/iconfile/docx.png';
                                break;
                            case 'exe':
                                $type = 'exe';
                                $icon = '../Content/Images/iconfile/exe.png';
                                break;
                            case 'gif':
                                $type = 'gif';
                                $icon = '../Content/Images/iconfile/gif.png';
                                break;
                            case 'html':
                                $type = 'html';
                                $icon = '../Content/Images/iconfile/html.png';
                                break;
                            case 'jpg':
                                $type = 'jpg';
                                $icon = '../Content/Images/iconfile/jpg.png';
                                break;
                            case 'js':
                                $type = 'js';
                                $icon = '../Content/Images/iconfile/js.png';
                                break;
                            case 'log':
                                $type = 'log';
                                $icon = '../Content/Images/iconfile/log.png';
                                break;
                            case 'mp3':
                                $type = 'mp3';
                                $icon = '../Content/Images/iconfile/mp3.png';
                                break;
                            case 'mp4':
                                $type = 'mp4';
                                $icon = '../Content/Images/iconfile/mp4.png';
                                break;
                            case 'pdf':
                                $type = 'pdf';
                                $icon = '../Content/Images/iconfile/pdf.png';
                                break;
                            case 'png':
                                $type = 'png';
                                $icon = '../Content/Images/iconfile/png.png';
                                break;
                            case 'ppt':
                                $type = 'ppt';
                                $icon = '../Content/Images/iconfile/ppt.png';
                                break;
                            case 'php':
                                $type = 'php';
                                $icon = '../Content/Images/iconfile/php.png';
                                break;
                            case 'rar':
                                $type = 'rar';
                                $icon = '../Content/Images/iconfile/rar.png';
                                break;
                            case 'sql':
                                $type = 'sql';
                                $icon = '../Content/Images/iconfile/sql.png';
                                break;
                            case 'txt':
                                $type = 'txt';
                                $icon = '../Content/Images/iconfile/txt.png';
                                break;
                            case 'zip':
                                $type = 'zip';
                                $icon = '../Content/Images/iconfile/zip.png';
                                break;
                            default:
                                $type = 'undefined';
                                $icon = '../Content/Images/iconfile/default.png';
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
            </div>
        </div>
    </div>
    <ul class='custom-menu'>
        <li class="restore" data-action="Restore">
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false" class="undefined">
            <path d="M0 0h24v24H0z" fill="none"></path>
            <path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"></path>
        </svg>
            Restore
        </li>
        <li class="harddelete" data-action="Delete">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false" class="undefined">
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13z"></path>
                <path d="M9 8h2v9H9zm4 0h2v9h-2z"></path>
            </svg>
            Hard delete
        </li>
    </ul>
    <!-- Restore dialog -->
    <div class=" modal fade" id="restoremodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Restore</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <p>Are you sure you want to restore?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id='restore'>Restore</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete dialog -->
    <div class=" modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hard delete</h4>
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
                        <input type="hidden" name="totalSize" value=<?= $totalSize ?> id="totalSize">
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
    <?php

    if ($totalSize > 1000000) {
        $totalSize = round($totalSize / 1000000.0, 1) . ' MB';
    } else if ($totalSize > 1000) {
        $totalSize = round($totalSize / 1000.0, 1) . ' KB';
    } else {
        $totalSize = $totalSize . ' Bytes';
    }

    ?>
    <script>
        $(document).ready(function() {

            $('.totalSize').text("<?= $totalSize . ' used' ?>");
        })
    </script>
</body>

</html>