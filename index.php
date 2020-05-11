<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ./views/login.php');
}
if (isset($_SESSION['name'])) {
    echo $_SESSION['name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    $root = 'D:/files/' . $_SESSION['user'];
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
    if ($create && $folder) {

        if (file_exists($dir_path . '/' . $folder)) {
            $mess = 'ton tai';
        } else {
            mkdir($dir_path . '/' . $folder);
            unset($_POST);
            header("Location: ./");
        }
    }
    $files = scandir($dir_path);
    echo $dir_path;
    ?>
    <style>
        tr.header {
            font-weight: bold;
            color: white;
            background-color: deepskyblue;
        }

        td {
            padding: 10px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(".rename").click(function() {

                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

            });

            $(".rename").click(function() {
                var allName = $(".link").text();

                var newName;
                var item = this.parentNode.parentNode;
                var a = $(this).attr('href');
                var parent = $("tr").has(this)[0].querySelector(".link");
                var Name = $("tr").find($("tr").find(parent))[0]['text'];

                $("#save").click(function() {
                    newName = $("#newname").val();
                    console.log(allName)
                    if (allName.search(newName) != -1) {
                        console.log("trung");
                        $(".message").text("Name exist");
                        return;
                    }

                    $.post("http://localhost:8888/BuffaloDrive/Upload/views/rename.php", {
                            name: Name,
                            path: "<?= $dir_path ?>",
                            newname: newName
                        },
                        function(data, status) {
                            console.log(status);
                            if (status) {
                                $("tr").find($("tr").find(parent))[0]['text'] = newName;
                                $(".newName").val("");
                            }
                        });
                })

            })

            $(".delete").click(function() {
                var item = this.parentNode.parentNode;
                var a = $(this).attr('href');
                var parent = $("tr").has(this)[0].querySelector(".link");
                var Name = $("tr").find($("tr").find(parent))[0]['text'];
                $('#myModal1').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#delete').click(function() {
                    $.post("http://localhost:8888/BuffaloDrive/Upload/views/delete.php", {
                            name: Name,
                            path: "<?= $dir_path ?>"
                        },
                        function(data, status) {
                            if (status) {
                                item.remove();
                            }
                        });
                })
            });




        });
    </script>
    <a href="./views/logout.php">Đăng xuất</a>

    <br>
    <div style="width: 300px; margin: auto; margin-bottom: 50px">
        <form method="post">
            <input type="text" name="folderName">
            <input type="submit" value="New folder" name="create">
        </form>
        <p class="message"><?= $mess ?></p>
        <br>

        <form action="./views/addfile.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="hidden" name="path" value="<?= $dir_path.'/' ?>">
            <input type="submit" value="Upload" name="submit">
        </form>

    </div>



    <table border="1" cellpadding="15" cellspacing="10" style="text-align: center; margin: auto; border-collapse: collapse">
        <tr>
            <td colspan="6">
                <a href="<?= $back ?>"><button>Back</button></a>
            </td>
        </tr>
        <tr class="header">
            <td>Icon</td>
            <td>File name</td>
            <td>Type</td>
            <td>Last modified</td>
            <td>File size</td>
            <td>Action</td>
        </tr>
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
            if ($isDir) {
                $dirLink = "?dir=$dirLink";
            } else {
                $dirLink = 'http://localhost:8888/' . $dirLink;
            }

            if (!$isDir) {
                $size = filesize($path);
                if ($size > 1000000) {
                    $size = round($size / 1000000.0, 1) . ' MB';
                } else if ($size > 1000) {
                    $size = round($size / 1000.0, 1) . ' KB';
                } else {
                    $size = $size . ' Bytes';
                }
            }
            if ($isDir) {
                $type = 'Directory';
                $icon = './Content/Images/Folder-icon.png';
            } else if ($ext == 'html') {
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
            <tr>
                <td><img src=<?= $icon ?>></td>
                <td><a href="<?= $dirLink ?>" class="link"><?= $file ?></a></td>
                <td><?= $type ?></td>
                <td><?= $time ?></td>
                <td><?= $size ?></td>
                <td><a href="#" class="rename">Rename</a> | <a href="#" class="delete">Delete</a></td>
            </tr>

        <?php

        }
        ?>
    </table>


    <!-- Rename dialog -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Đổi tên thư mục</h4>
                </div>
                <div class="modal-body">
                    <p>Nhập tên mới.</p>
                    <input type="text" id="newname">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id='save'">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Rename dialog -->
    <!-- Delete dialog -->
    <div class=" modal fade" id="myModal1" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Đổi tên thư mục</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn xóa ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id='delete'>Xóa</button>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- Delete dialog -->



</body>

</html>