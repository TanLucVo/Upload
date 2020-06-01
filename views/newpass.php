<?php
	require_once '../function.php';
	require_once '../config.php';
	require_once './random_token.php';
	session_start();
	//bcrypt
	$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
	$salt = sprintf("$2y$%02d$", 10) . $salt; //$2y$ là thuật toán BlowFish, 10 là độ dài của key mã hóa.
	$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
	$mess ='';
	if (isset($_POST["change-password"])) {
		//lấy thông tin từ các form bằng phương thức POST

		$password = crypt($_POST["password"], $salt);
		$username_token = getUserbyToken($token,$conn);
		if (!checkUser($username_token, $conn)){
			updatePassByUser($password,$username_token,$conn);
			updateTokenByUser(random_string(30),$username_token,$conn);
			$mess = 'Password change successfully';
			header('Location: ./login.php');
		}
		else{
			$mess = 'Password change failed';
			header('Location: ./newpass.php?token=' . $token);
		}
	}
?>
<!doctype html>
<html>
<head>
	<title>Buffalo Drive</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="../Content/Scripts/jquery.min.js"></script>
	<script src="../Content/Scripts/popper.min.js"></script>
	<script src="../Content/Scripts/login_register.js"></script>
	<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
	<link href="../Content/Styles/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../Content/Styles/register.css" rel='stylesheet' type='text/css' media="all" />
</head>
<body>
<h1 class="w3ls">Change Password</h1>
<div class="content-w3ls">
	<div class="content-agile1">
		<h2 class="agileits1">Buffalo-Drive</h2>
	</div>
	<div class="content-agile2">
		<form action="" method="post">
            <div class="form-control agileinfo">	
				<input type="password" class="lock" name="password" placeholder="Password" id="password1" required="">
			</div>	

			<div class="form-control agileinfo">	
				<input type="password" class="lock" name="confirm-password" placeholder="Confirm Password" id="password2" required="">
			</div>	
			
            <input type="submit" class="register" name="change-password" value="Change password">
			<a class="cancel" href="./login.php">Cancel</a>
			<p class="notification-newpass"><?= $mess ?></p>
		</form>
		<script type="text/javascript">
			window.onload = function () {
				document.getElementById("password1").onchange = validatePassword;
				document.getElementById("password2").onchange = validatePassword;
			}
			function validatePassword(){
				var pass2=document.getElementById("password2").value;
				var pass1=document.getElementById("password1").value;
				if(pass1!=pass2)
					document.getElementById("password2").setCustomValidity("Passwords Don't Match");
				else
					document.getElementById("password2").setCustomValidity('');
					//empty string means no validation error
			}
		</script>
    </div>
	<div class="clear"></div>
</div>

<p class="copyright w3l">© 2020 Official Change Password Form. All Rights Reserved.</p>
</body>
</html>