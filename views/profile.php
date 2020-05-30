<?php
require_once '../function.php';
require_once '../config.php';

session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['name'])) {
    header('Location: ./login.php');
} 
$usershare = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_STRING);
$user = $_SESSION['user'];
if (isset($usershare)) {
    if ($user == $usershare) {
        header('Location: ./profile.php');
    }

    $profile = $usershare;
    $infor = getInforByUser($profile, $conn);
    if ($infor == null) {
        header('Location: ./error.php');
    }
    $mine = false;
} else {
    if (!isset($_SESSION['user']) || !isset($_SESSION['name'])) {
        header('Location: ./login.php');
    } else {
        $user = $_SESSION['user'];
        $name = $_SESSION['name'];
    }
    $profile = $user;
    $infor = getInforByUser($profile, $conn);
    $mine = true;
}

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
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <p class="text-center mb-0"></p>
                    </div>
                    <form class="form-horizontal" role="form" id='edit'>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">First name:</label>
                            <div class="col-lg-8">
                                <input type="text" value="<?= $infor['firstname'] ?>" id='first-name' class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Last name:</label>
                            <div class="col-lg-8">
                                <input type="text" value="<?= $infor['lastname'] ?>" id='last-name' class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-8">
                                <input type="email" value="<?= $infor['email'] ?>" id='email' class="form-control" required>
                            </div>
                        </div>
                        <?php
                            if($mine){
                                echo "<div class='form-group' id='pass1'>
                            <label class='col-md-3 control-label'>Password:</label>
                            <div class='col-md-8'>
                                <input class='form-control' id='password1' type='password' required>
                            </div>
                            </div>
                            <div class='form-group' id='pass2'>
                                <label class='col-md-3 control-label'>Confirm password:</label>
                                <div class='col-md-8'>
                                    <input class='form-control' id='password2' type='password' value='' required>
                                </div>
                            </div>
                            <div class='form-group' id='showpass'>
                                <div class='col-md-8'>
                                    <input type='checkbox' onclick='myShowPassword()'>Show Password
                                </div>
                            </div>
                            <div class='form-group' id='control'>
                                <label class='col-md-3 control-label'></label>
                                <div class='col-md-8'>
                                    <a href='../' class='btn btn-default'>Cancel</a>
                                    <input type='submit' value='Save' class='btn btn-primary'>
                                    <span></span>
                                </div>
                            </div>";
                            }           
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <script>
        $(document).ready(function() {
            <?php
            if (!$mine) {
                echo "$('.container input').prop('disabled', true);";
            }
            ?>
            $(".alert").hide();
            $('#edit').submit(function(e) {
                console.log(1);
                e.preventDefault(e);
                if ($('#password1').val() !== $('#password2').val()) {
                    $(".alert p").text('Password must be same');
                    $(".alert").show(500);
                    return;
                }
                var username = "<?= $user ?>";
                var pass = $('#password1').val();
                var firstname = $('#first-name').val();
                var lastname = $('#last-name').val();
                var email = $('#email').val();
                $.post(
                    "http://localhost:8888/BuffaloDrive/Upload/views/update.php", {
                        username: username,
                        pass: pass,
                        firstname: firstname,
                        lastname: lastname,
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