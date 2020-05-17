<hr>
<div class="current-page">
    <h5>My Driver</h5>
</div>
<hr>
<table style="width: 100%" border="1" cellpadding="15" cellspacing="10" style="text-align: center; margin: auto; border-collapse: collapse">
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
            $dirLink = $dir_path . '/' . $file;
            $dirLink = str_replace('C:/xampp/htdocs/', 'http://localhost:8888/', $dirLink);
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


<!-- Model in jquery -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Đổi tên thư mục</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

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
</div>
<!-- Delete dialog -->
<div class=" modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Đổi tên thư mục</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

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
                    <form action="./views/addfile.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
                        <input type="hidden" name="path" value="<?= $dir_path . '/' ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
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
                <form method="post">
                    <div class="modal-body">
                        <input type="text" name="folderName">
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-success" type="submit" value="New folder" name="create">
                        <p class="message"><?= $mess ?></p>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </div>