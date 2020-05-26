<?php
require_once './function.php';
require_once './config.php';

session_start();
$link = ($_SERVER['REQUEST_URI']);
$usershare = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_STRING);
$dirName = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING);
if (!isset($dirName) && !isset($usershare)) {
    header('Location: ./error.html');
}
if (!file_exists("C:/xampp/htdocs/BuffaloDrive/Upload/files/" . $usershare)) {
    header('Location: ./error.html');
}
if (isset($_SESSION['usershare']) && file_exists("C:/xampp/htdocs/BuffaloDrive/Upload/files/" . $usershare) && isset($usershare)) {
    $_SESSION['usershare'] = $usershare;
} else if (file_exists("C:/xampp/htdocs/BuffaloDrive/Upload/files" . $usershare) && !isset($_SESSION['usershare'])) {
    $_SESSION['usershare'] = $usershare;
    header('Location: http://localhost:8888/BuffaloDrive/Upload/sharepage.php?user=' . $usershare);
} else if (isset($_SESSION['usershare'])) {
    $usershare = $_SESSION['usershare'];
}

if (isset($_SESSION['user']) || !isset($_SESSION['user'])) {
    if ($usershare == $_SESSION['user']) {
        header('Location: http://localhost:8888/BuffaloDrive/Upload');
    }
}

$name = $_SESSION['name'];
$link = GetShareLinkByUser($usershare, $conn);
if ($link->num_rows > 0) {
    // output data of each row
    $allLink = array();
    while ($row = $link->fetch_assoc()) {
        array_push($allLink, $row['link']);
    }
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
            <a href="./"><img src="./Content/Images/logo.png" alt="Buffalo Drive" class="navbar-brand" width=70px></a>
            <a class="navbar-brand" href="./">Buffalo Drive</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <form class="form-inline my-2 my-lg-0 search">
                <input class="form-control mr-auto p-3 mr-mb-0" type="search" placeholder="Search" aria-label="Search">
            </form>
            <div class="infor d-flex flex-row bd-highlight mb-3">
                <img src="./Content/Images/avatar.png" alt="">
                <a href="./views/profile.php"><?= $name ?></a>
                <a href="./views/logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <?php
    $root = "C:/xampp/htdocs/BuffaloDrive/Upload/files/" . $usershare;

    $create = filter_input(INPUT_POST, 'create', FILTER_SANITIZE_STRING);
    $folder = filter_input(INPUT_POST, 'folderName', FILTER_SANITIZE_STRING);

    $url = $_SERVER['REQUEST_URI'];
    // $back = 'http://localhost:8888' . '' . substr($url, 0, strrpos($url, '/'));
    if ($dirName) {

        $dir_path = $root . '/' . $dirName;
    } else {
        $dir_path = $root;
    }
    $mess = '';
    // $dir_path=str_replace("dir=1", '123123', $dir_path);
    if (!file_exists($root) && $user != 'admin') {
        mkdir($root);
    }
    if (file_exists($dir_path)) {
        $files = scandir($dir_path);
    } else {
        header('Location: ./error.html');
    }
    ?>
    <div>
        <div class="row">
            <div class="sticky col-6 col-lg-3 col-sm-5 left" id="left">
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
                    <a class="d-inline" href="./">My Drive</a>
                </div>
                <div class="trash d-flex">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false" class="undefined ">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13z"></path>
                        <path d="M9 8h2v9H9zm4 0h2v9h-2z"></path>
                    </svg>
                    <a href="./views/trash.php">Trash</a>
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
            <div class="col-6 col-lg-9 col-sm-7 right" id="right">
                <?php require_once './views/userpage.php' ?>
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
            Delete
        </li>
        <li class="rename" data-action="Rename">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false" class="undefined">
                <path d="M1,15.25V19h3.75L15.814,7.936l-3.75-3.75L1,15.25z M18.707,5.043c0.391-0.391,0.391-1.023,0-1.414l-2.336-2.336  c-0.391-0.391-1.024-0.391-1.414,0l-1.832,1.832l3.75,3.75L18.707,5.043z"></path>
            </svg>
            Rename
        </li>
        <li class="download" data-action="Download">
            <a href="#">
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false" class="undefined">
                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"></path>
                </svg>
                Download
            </a>
        </li>
        <li class="share" data-action="Share">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#000000" focusable="false" class="undefined">
                <path d="M3.9,12c0-1.7,1.4-3.1,3.1-3.1h4V7H7c-2.8,0-5,2.2-5,5s2.2,5,5,5h4v-1.9H7C5.3,15.1,3.9,13.7,3.9,12z M8,13h8v-2H8V13zM17,7h-4v1.9h4c1.7,0,3.1,1.4,3.1,3.1s-1.4,3.1-3.1,3.1h-4V17h4c2.8,0,5-2.2,5-5S19.8,7,17,7z"></path>
            </svg>
            Share this file
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
                                    <input type="hidden" name="path" value="C:/xampp/htdocs/BuffaloDrive/Upload/files/<?= $_SESSION['user'] ?>/" id='pathfile'>
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
                                    <input type="hidden" name="folderPath" value="C:/xampp/htdocs/BuffaloDrive/Upload/files/<?= $_SESSION['user'] ?>" id='folderPath'>

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
                        // $('.folder a').attr('href', '#');
                        $('.custom-menu .delete, .custom-menu .rename, .custom-menu .share').remove();
                        $('.custom-menu').append()
                    })
                </script>
</body>

</html>