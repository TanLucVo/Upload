<?php
	require_once '../function.php';
	require_once '../config.php';
	require_once './random_token.php';
	session_start();
	$mess ='';

	if (isset($_POST["register"])) {
		//lấy thông tin từ các form bằng phương thức POST
		//bcrypt
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2y$%02d$", 10) . $salt; //$2y$ là thuật toán BlowFish, 10 là độ dài của key mã hóa.

		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$username = $_POST["username"];
		
		$password = crypt($_POST["password"], $salt);
		$passwordlv2 = crypt($_POST["passwordlv2"], $salt);

		$email = $_POST["email"];
		if (!checkUser($username, $conn)) {
			$mess =  "Username already exists, please enter it again";
		}elseif ($username == "admin"){
			$mess =  "Unable to create this username";
		}else{
			register($username,$password,$firstname,$lastname,$email,$conn);
			addPasslv2($username,$passwordlv2,random_string(30),$conn);
			$_SESSION['passlv2_default'] = $_POST["passwordlv2"];
			header('Location: ./login.php');
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
<h1 class="w3ls">Signup</h1>
<div class="content-w3ls">
	<div class="content-agile1">
		<h2 class="agileits1">Buffalo-Drive</h2>
	</div>
	<div class="content-agile2">
		<form action="./register.php" method="post">
			<div class="form-control"> 
				<input type="text" id="firstname" name="firstname" placeholder="First Name" title="Please enter your First Name" required="">
			</div>

			<div class="form-control"> 
				<input type="text" id="lastname" name="lastname" placeholder="Last Name" title="Please enter your Last Name" required="">
			</div>

			<div class="form-control"> 
				<input type="text" id="username" name="username" placeholder="User Name" title="Please enter your User Name" required="">
			</div>

			<div class="form-control">	
				<input type="email" id="email" name="email" placeholder="mail@example.com" title="Please enter a valid email" required="">
			</div>

			<div class="form-control agileinfo">	
				<input type="password" class="lock" name="password" placeholder="Password" id="password1" required="">
			</div>	

			<div class="form-control agileinfo">	
				<input type="password" class="lock" name="confirm-password" placeholder="Confirm Password" id="password2" required="">
			</div>

			<div class="form-control agileinfo">	
				<input type="password" class="lock" name="passwordlv2" placeholder="Password Level 2" id="pass" required="">
			</div>	

			<input type="submit" class="register" name="register" value="Register">
			<a class="cancel" href="./login.php">Cancel</a>
			<p class="notification-register"><?= $mess ?></p>
			
		</form>
		<script type="text/javascript">
			window.onload = function () {
				document.getElementById("password1").onchange = validatePassword;
				document.getElementById("password2").onchange = validatePassword;
				document.getElementById("pass").onchange = validatePassword;
			}
			function validatePassword(){
				var pass2=document.getElementById("password2").value;
				var pass1=document.getElementById("password1").value;
				var pass=document.getElementById("pass").value;
				if(pass1!=pass2)
					document.getElementById("password2").setCustomValidity("Passwords Don't Match");
				else
					document.getElementById("password2").setCustomValidity('');
					//empty string means no validation error
				if(pass1==pass)
					document.getElementById("pass").setCustomValidity(`Password level 2 isn't same Password login`);
				else
					document.getElementById("pass").setCustomValidity('');
			}
		</script>
	</div>
	<div class="clear"></div>
</div>
<p class="copyright w3l">© 2020 Official Signup Form. All Rights Reserved.</p>
</body>
</html>