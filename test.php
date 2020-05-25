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
</head>

<body>
    <form method="post" id='settings'>
        <input type="text" name="data" id="totalData">
        <input type="text" name="numfile" id="numFile">
        <input type="text" name="filedata" id="fileData">
        <input type="text" name="typeNotAceppt" id="typeNotAccept">
        <input type="submit" value="submit">
    </form>
    <script>
        $(document).ready(function() {

            $('#settings').submit(function() {
                var data = $('#totalData').val();
                var numfile = $('#numFile').val();
                var filedata = $('#fileData').val();
                var typeNotAceppt = $('#typeNotAccept').val();
                $.post(
                    "http://localhost:8888/BuffaloDrive/Upload/views/settings.php", {
                        data: $('#totalData').val(),
                        numfile: $('#numFile').val(),
                        filedata: $('#fileData').val(),
                        typeNotAceppt: $('#typeNotAccept').val(),

                    },
                    function(status) {
                        console.log(status);
                    }
                );
            })

        })
    </script>
</body>

</html>