<?php
include('../function.php');
session_start();
require_once('../config.php');
$mess = '';
if (isset($_SESSION['user'])) {
    header('Location: ../');
}
if (isset($_POST['user']) && $_POST['pass']) {
    $result = login($_POST['user'], $_POST['pass'], $conn);
    if ($result == null) {
        $mess = 'Sai mk';
    } else {
        $_SESSION['user'] = $result['username'];
        $_SESSION['name'] = $result['name'];
        header('Location: ../');
    }
}
?>
<!doctype html>
<html>
<head>
<title>Buffalo Drive</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Official Signup Form Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- fonts -->
<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
<!-- /fonts -->
<!-- css -->
<link href="../Content/Styles/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Content/Styles/register.css" rel='stylesheet' type='text/css' media="all" />
<!-- /css -->
</head>
<body>
<h1 class="w3ls">Login Form</h1>
<div class="content-w3ls">
	<div class="content-agile1">
		<h2 class="agileits1">Buffalo-Drive</h2>
	</div>
	<div class="content-agile2">
		<form action="" method="post">
			<div class="form-control"> 
				<input type="text" id="username" name="user" placeholder="User Name" title="Please enter your User Name" required="">
			</div>

			<div class="form-control agileinfo">	
				<input type="password" class="lock" name="pass" placeholder="Password" id="pass" required="">
			</div>			
			
            <input type="submit" class="register" name="login" value="Login">
			<div class="form-check">
				<input type="checkbox" id="remember_me" name="_remember_me"/>
				<label for="remember_me" class="remember_me">Remember me</label>
				<a href="" class="forgot">Forgot password?</a>
            </div>
            <div class="form-register-check">
                <a class="check-register" href="http://localhost:8888/BuffaloDrive/Upload/signup.php" >You don't have account?</a>
            </div>
		</form>
    </div>
	<div class="clear"></div>
</div>

<p class="copyright w3l">© 2020 Official Login Form. All Rights Reserved.</p>
</body>
</html>