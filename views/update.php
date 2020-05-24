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

    $infor = getInforByUser($user,$conn);
    $myName = explode(" ", $infor["name"]);
    if (isset($_POST["saveprofile"])) {
        $mess ='';
        
        //lấy thông tin từ các form bằng phương thức POST
        $name = $_POST["firstname"]." ".$_POST["lastname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        if (!checkUser($username, $conn)) {
            $mess =  "Username already exists, please enter it again.";
            $_SESSION['mess'] = $mess;
            unset($_POST);
            header('Location: ./update.php');
        }else{
            $mess =  "You have successfully edited my account.";
            $_SESSION['mess'] = $mess;
            unset($_POST);
            editProfile($username,$password,$name,$email,$conn,$infor["name"]);
            
            header('Location: ./profile.php');
        }
    }
    // if(isset($_SESSION['mess'])){
    //     $mess = $_SESSION['mess'];
    // }else{
    //     $mess = '';
    // }
    // unset($_SESSION['mess']);
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
            <a class="navbar-brand" href="../">Buffalo Drive</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <form class="form-inline my-2 my-lg-0 search">
                <input class="form-control mr-auto p-3 mr-mb-0" type="search" placeholder="Search" aria-label="Search">
            </form>
            <div class="infor d-flex flex-row bd-highlight mb-3">
                <a href="./profile.php"><img src="../Content/Images/avatar.png" alt="<?= $name ?>"></a>
                <a href="./profile.php"><p class="text-justify"><?= $name ?></p></a>
                <a href="./logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Edit profile -->
    <div class="editprofile">
        <div class="container">
            <h1>Edit Profile</h1>
            <hr>
            <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                <img src="../Content/Images/avatar.png" class="avatar img-circle" alt="avatar" width="150px">
                
                <input type="file" class="form-control">
                </div>
            </div>
            
            <!-- edit form column -->
            <div class="col-md-9 personal-info">
                <div class="alert alert-info alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a> 
                <i class="fa fa-coffee"></i>
                <!-- <?= $mess ?> -->
                </div>
                <h3>Personal info</h3>
                
                <form class="form-horizontal" role="form" action="./update.php" method="post">
                <div class="form-group">
                    <label class="col-lg-3 control-label">First name:</label>
                    <div class="col-lg-8">
                    <input class="form-control" type="text" id="firstname" name="firstname" placeholder="First Name" title="Please enter your First Name" required="" value="<?= $myName[1] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Last name:</label>
                    <div class="col-lg-8">
                    <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Last Name" title="Please enter your Last Name" required="" value="<?= $myName[0] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                    <input class="form-control" type="email" id="email" name="email" placeholder="mail@example.com" title="Please enter a valid email" required="" value="<?= $infor["email"] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Username:</label>
                    <div class="col-md-8">
                    <input class="form-control" type="text" id="username" name="username" placeholder="User Name" title="Please enter your User Name" required="" value="<?= $infor["username"] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-8">
                    <input class="form-control" type="password" class="lock" name="password" placeholder="Password" id="password_edit" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm password:</label>
                    <div class="col-md-8">
                    <input class="form-control" type="password" class="lock" name="confirm-password" placeholder="Confirm Password" id="confirmpassword_edit" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                    <input type="checkbox" onclick="editShowPassword()">Show Password
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                    <input type="submit" class="btn btn-primary" name="saveprofile" value="Save Changes">
                    <span></span>
                    <a href="./profile.php" class="btn btn-default">Cancel</a>
                    </div>
                </div>
                </form>
                <script type="text/javascript">
                    window.onload = function () {
                        document.getElementById("password_edit").onchange = validatePassword;
                        document.getElementById("confirmpassword_edit").onchange = validatePassword;
                    }
                    function validatePassword(){
                        var pass2=document.getElementById("confirmpassword_edit").value;
                        var pass1=document.getElementById("password_edit").value;
                        if(pass1!=pass2)
                            document.getElementById("confirmpassword_edit").setCustomValidity("Passwords Don't Match");
                        else
                            document.getElementById("confirmpassword_edit").setCustomValidity('');	 
                            //empty string means no validation error
                    }
                </script>
            </div>
        </div>
    </div>
    <hr>
</body>
</html>