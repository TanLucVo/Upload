$(document).ready(function(){
    $(".rename").click(function () {
        
        $("#myModal").modal({
            backdrop: "static",
            keyboard: false,
        });
    });
    $('#newFolderForm').submit(function(e){
        e.preventDefault(e);
        $.post(
            "http://localhost:8888/BuffaloDrive/Upload/views/addFolder.php", {
            folderName: $('#folderName').val(),
            folderPath: $('#folderPath').val(),
        },
            function (status) {
                $('.message').text(status.replace(/"/g, "").trim());
                $("[data-dismiss=modal]").click(function () {
                    location.reload();
                })
            }
        );
    })
    $("#newfile").click(function () {
        $("#addFile").modal({
            backdrop: "static",
            keyboard: false,
        });
    });
    $("#settings-btn").click(function (e) {
        
        $("#setting-modal").modal({
            backdrop: "static",
            keyboard: false,
        });
        e.preventDefault(e);
        
    });
    $('#setting-form').submit(function (e) {
        e.preventDefault(e);
        var data = $('#totalData').val();
        var numfile = $('#numFile').val();
        var filedata = $('#filedata').val();
        var typeNotAceppt = $('#typeNotAccept').val();

        $.post(
            "http://localhost:8888/BuffaloDrive/Upload/views/settings.php", {
            data: data,
            numfile: numfile,
            filedata: filedata,
            typeNotAceppt: typeNotAceppt,

        },
            function (status) {
                $('.message').text(status);
                $("[data-dismiss=modal]").click(function () {
                    location.reload();
                })
            }
        );
    })
    $("#newfolder").click(function () {
        $("#addFolder").modal({
            backdrop: "static",
            keyboard: false,
        });
    });

    $(".rename").click(function () {
        var path = $('.custom-menu').data()['link'];
        name = path.substring(path.lastIndexOf("/") + 1, path.length)
        path = path.substring(0, path.lastIndexOf("/"));
        $('#newname').val(name)
        var nameItem = $('.card-title').map(function () {
            return $.trim($(this).text());
        }).get();
        var nameFolder = $('.folder').map(function () {
            return $.trim($(this).text());
        }).get();
        $("#save").click(function () {
            newName = $("#newname").val();
            if (nameItem.includes(newName) || nameFolder.includes(newName)) {
                alert('name esitsx');
                return;
            }

            $.post(
                "http://localhost:8888/BuffaloDrive/Upload/views/rename.php", {
                name: name,
                path: path,
                newname: newName,
            },
                function (data, status) {
                    if (status) {
                        var path = $('.custom-menu').data()['file'];
                        path.find('a').text(newName);
                        location.reload();
                    }
                }
            );
        });
    });

    $(".delete").click(function () {

        var item = $('.custom-menu').data()['file'];
        $("#myModal1").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#delete").click(function () {
            $.post(
                "http://localhost:8888/BuffaloDrive/Upload/views/delete.php", {
                path: $('.custom-menu').data()['link'],
            },
                function (data, status) {
                    if (status) {
                        item.remove();
                        location.reload();
                    }
                }
            );
        });
    });
    $(".restore").click(function () {

        var item = $('.custom-menu').data()['file'];
        $("#restoremodal").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#restore").click(function () {
            $.post(
                "http://localhost:8888/BuffaloDrive/Upload/views/restore.php", {
                path: $('.custom-menu').data()['link'],
            },
                function (data, status) {
                    if (status) {
                        item.remove();
                        location.reload();
                    }
                }
            );
        });
    });
    $(".harddelete").click(function () {

        var item = $('.custom-menu').data()['file'];
        $("#myModal1").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#delete").click(function () {
            $.post(
                "http://localhost:8888/BuffaloDrive/Upload/views/harddelete.php", {
                path: $('.custom-menu').data()['link'],
            },
                function (data, status) {
                    if (status) {
                        item.remove();
                        location.reload();
                    }
                }
            );
        });
    });
    $('.share').click(function () {
        $.post(
            "http://localhost:8888/BuffaloDrive/Upload/views/sharefile.php", {
            path: $('.custom-menu').data()['link'],
        },
            function (data, status) {
                if (status) {
                
                }
            }
        );
    })
    $('.folder').click(function(){
        var link = $(this).find('a').attr("href");
        location.href = link;
    })
    $('.folder, .file-item').bind("contextmenu", function (event) {
        var path = $(this).find('input').val();
        var name = '';
        if ($(this).hasClass('folder')){
            name = '/'+$(this).find('a:first-child').text();
        }
        name = name.trim();
        $('.custom-menu').data("link",path+''+name);
        $('.custom-menu').data("file", $(this));
        // Avoid the real one
        event.preventDefault();

        // Show contextmenu
        $(".custom-menu").finish().toggle(100).
        
        // In the right position (the mouse)
        css({
            top: event.pageY + "px",
            left: event.pageX + "px"
        });
        
    });
    
    $('.download').click(function () {
        var file = $('.custom-menu').data()['file'];
        name=$('.custom-menu').data()['file'].text().trim();
        if(file.hasClass('folder')){
            $.post(
                "http://localhost:8888/BuffaloDrive/Upload/views/downfolder.php", {
                    path: $('.custom-menu').data()['link'],
                    name: name
                },
                function (data, status) {
                    if (status) {
                        location.reload();
                        window.open("http://localhost:8888/BuffaloDrive/Upload/views/downfolder.php");
                    }
                }
            );
        }
        else{
            var link = $('.custom-menu').data()['link'];
            link = link.replace('C:/xampp/htdocs', 'http://localhost:8888');
            var name = $('.custom-menu').data()['file'].find('a').text();
            $(this).find('a').attr('href', link);
            $(this).find('a').attr('download', name);
        }
        
    })
    // If the document is clicked somewhere
    $('.folder, .file-item').bind("mousedown", function (e) {
        // If the clicked element is not the menu
        if (!$(e.target).parents(".custom-menu").length > 0) {

            // Hide it
            $(".custom-menu").hide(100);
        }
    });
    
    $('#uploadFile').submit(function(e){

        e.preventDefault(e);
        var form_data = new FormData();
        var path = $('#pathfile').val();
        var totalfiles = document.getElementById('fileToUpload').files.length;
        for (var index = 0; index < totalfiles; index++) {
            form_data.append("fileToUpload[]", document.getElementById('fileToUpload').files[index]);
        }
        form_data.append("path", path);
        form_data.append("totalSize", $('#totalSize').val());
        // if ($(this).prop('files').length > 0) {
        //     file = $(this).prop('files')[0];
        //     formdata.append("fileToUpload[]", file);
        // }
        // formdata.append("path", $('#pathfile').val());
        $.ajax({
            xhr:function(){
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress",function(evt){
                    if(evt.lengthComputable){
                        var percentComplete = ((evt.loaded / evt.total) * 100).toFixed(2);
                        $('.progress-bar').width(percentComplete + '%');
                        $('.progress-bar').html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: 'http://localhost:8888/BuffaloDrive/Upload/views/addfile.php',
            type: "POST",
            contentType: false, // Not to set any content header  
            processData: false, // Not to process data  
            cache : false,
            data: form_data,
            beforeSenf:function(){
                $('.progress-bar').width('0%');
            },
            success: function (result) {
                if (result != "") {
                    result = result.replace('<br>', '<br/>').trim()
                    $('#status').html(result.replace(/"/g, ""));
                    $('#status').show();
                }
                $("[data-dismiss=modal]").click(function () {
                    location.reload();
                })
            },
            error: function (err) {
                alert(err.statusText);
            }
        });
  


    })



    // If the menu element is clicked
    $(".custom-menu li").click(function () {
        $(".custom-menu").hide(100);
    });
    $(document).click(function(){
        $(".custom-menu").hide(100);
    })
    $('#uploadFile #fileToUpload').change(function () {
        $('#uploadFile p').first().text(this.files.length + " file(s) selected");
    });

})

//Profile
function editShowPassword() {
    var x = document.getElementById("password_edit");
    var y = document.getElementById("confirmpassword_edit");
    if (x.type === "password" || y.type === "password") {
        x.type = "text";
        y.type = "text";
    }
    else {
        x.type = "password";
        y.type = "password";

    }
}
function myShowPassword() {
    var x = document.getElementById("password1");
    if (x.type === "password") {
        x.type = "text";
    }
    else {
        x.type = "password";
    }
}