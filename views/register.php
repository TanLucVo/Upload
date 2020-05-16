<?php
	require_once '../function.php';
	require_once '../config.php';
	session_start();
	if (isset($_POST["register"])) {
		$mess ='';
		
        //lấy thông tin từ các form bằng phương thức POST
		$name = $_POST["firstname"]." ".$_POST["lastname"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		//Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
		if (!checkUser($username, $conn)) {
			$mess =  "Tên đăng nhập đã tồn tại";
			// $_SESSION['mess'] = $mess;
			unset($_POST);
			header('Location: ./register.php');
		}else{
			unset($_POST);
			register($username,$password,$name,$email, $conn);
			
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
<script src="Content/Scripts/login_register.js"></script>
<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
<link href="../Content/Styles/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Content/Styles/register.css" rel='stylesheet' type='text/css' media="all" />
</head>
<body>
<h1 class="w3ls">Signup Form</h1>
<div class="content-w3ls">
	<div class="content-agile1">
		<h2 class="agileits1">Buffalo-Drive</h2>
	</div>
	<div class="content-agile2">
		<form action="./views/register.php" method="post">
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
			<input type="submit" class="register" name="register" value="Register">
			<a class="cancel" href="http://localhost:8888/BuffaloDrive/Upload/views/login.php">Cancel</a>
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
<p class="copyright w3l">© 2020 Official Signup Form. All Rights Reserved.</p>
</body>
</html>