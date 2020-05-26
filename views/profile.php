<?php
require_once '../function.php';
require_once '../config.php';

session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['name'])) {
    header('Location: ./login.php');
} else {
    $user = $_SESSION['user'];
    $name = $_SESSION['name'];
}

$infor = getInforByUser($user, $conn);
$myName = explode(" ", $infor["name"]);
$email = $infor['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buffalo Drive</title>
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
                <a href="./profile.php"><img src="../Content/Images/avatar.png" alt="<?= $name ?>"></a>
                <a href="./profile.php" class="text-justify"><?= $name ?></a>
                <a href="./logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <!-- View profile -->
    <div class="viewprofile">
        <div class="container">
            <h1>Profile</h1>
            <hr>
            <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                <img src="../Content/Images/avatar.png" class="avatar img-circle" alt="avatar" width="150px">
                </div>
            </div>
            
            <div class="col-md-9 personal-info">
                <!-- <div class="alert alert-info alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a> 
                    <i class="fa fa-coffee"></i>
                    This is an <strong>.alert</strong>. Use this to show important messages to the user.
                </div> -->
                <h3>Personal info</h3>
                
                <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-lg-3 control-label">First name:</label>
                    <div class="col-lg-8">
                    <p><?= $myName[1] ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Last name:</label>
                    <div class="col-lg-8">
                    <p><?= $myName[0] ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                    <p><?= $infor["email"] ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Username:</label>
                    <div class="col-md-8">
                    <p><?= $user ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-8">
                    <input class="form-control" id="password1" type="password" value="<?= $infor["pass"] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                    <input type="checkbox" onclick="myShowPassword()">Show Password
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                    <a href="./update.php" class="btn btn-primary">Edit Profile</a>
                    <span></span>
                    </div>
                    <h3>Personal info</h3>

                    <form class="form-horizontal" role="form" id='edit'>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">First name:</label>
                            <div class="col-lg-8">
                                <input type="text" value="<?= $myName[1] . ' ' . $myName[2] ?>" id='first-name' class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Last name:</label>
                            <div class="col-lg-8">
                                <input type="text" value="<?= $myName[0] ?>" id='last-name' class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-8">
                                <input type="email" value="<?= $email ?>" id='email' class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password:</label>
                            <div class="col-md-8">
                                <input class="form-control" id="password1" type="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirm password:</label>
                            <div class="col-md-8">
                                <input class="form-control" id="password2" type="password" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="checkbox" onclick="myShowPassword()">Show Password
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <input type="submit" value="Save" class="btn btn-primary">
                                <span></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <script>
            $(document).ready(function() {

                $(".alert").hide();
                $('#edit').submit(function(e) {
                    e.preventDefault(e);
                    if ($('#password1').val() !== $('#password2').val()) {
                        $(".alert p").text('Password must be same');
                        $(".alert").show(500);
                        return;
                    }
                    var username = "<?= $user ?>";
                    var pass = $('#password1').val();
                    var name = $('#first-name').val() + ' ' + $('#last-name').val();
                    var email = $('#email').val();
                    $.post(
                        "http://localhost:8888/BuffaloDrive/Upload/views/update.php", {
                            username: username,
                            pass: pass,
                            name: name,
                            email: email,

                        },
                        function(data, status) {
                            if (status) {
                                $('.alert p').text('Updated');
                                $(".alert").show(500);
                            }
                        }
                    );

                })
            })
        </script>
</body>

</html>