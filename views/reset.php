<?php
	require_once '../function.php';
	require_once '../config.php';
	session_start();
	$mess ='';
	if (isset($_POST["submit"])) {
		//lấy thông tin từ các form bằng phương thức POST

		$username = $_POST["username"];
		$passwordlv2 = $_POST["passwordlv2"];

		if (checkUser($username, $conn)) {
			$mess =  "Username does not exist";
		}elseif ($username == "admin"){
			$mess =  "Unable to reset this username";
		}else{
			$result = checkPasslv2($username,$passwordlv2,$conn);
			if ($result == null) {
				$mess = 'Wrong password';
			}
			else {
				$token = $result['token'];
				header('Location: ./newpass.php?token=' . $token);
			}
		}
	}
?>
<!doctype html>
<html>
<head>
<title>Buffalo Drive</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="../Content/Scripts/login_register.js"></script>
<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
<link href="../Content/Styles/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Content/Styles/register.css" rel='stylesheet' type='text/css' media="all" />
</head>
<body>
<h1 class="w3ls">Reset Password</h1>
<div class="content-w3ls">
	<div class="content-agile1">
		<h2 class="agileits1">Buffalo-Drive</h2>
	</div>
	<div class="content-agile2">
		<form action="" method="post">

			<div class="form-control"> 
				<input type="text" id="username" name="username" placeholder="User Name" title="Please enter your User Name" required="">
			</div>	

			<div class="form-control agileinfo">	
				<input type="password" class="lock" name="passwordlv2" placeholder="Password Level 2" id="pass" required="">
			</div>

            <input type="submit" class="register" name="submit" value="Submit">
			<a class="cancel" href="./login.php">Cancel</a>
			<p class="notification-reset"><?= $mess ?></p>
		</form>
		
    </div>
	<div class="clear"></div>
</div>

<p class="copyright w3l">© 2020 Official Reset Password Form. All Rights Reserved.</p>
</body>
</html>