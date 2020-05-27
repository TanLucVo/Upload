<?php
	include('../function.php');
	session_start();
	require_once('../config.php');
	$mess = '';
	if (isset($_POST['login']) && $_POST['password']) {
		$result = adminlogin($_POST['login'], $_POST['password'], $conn);
		if ($result == null) {
			$mess = 'Wrong password';
		} else {
			$_SESSION['account_admin'] = $result['username'];
			header('Location: ../adminpage.php');
		}
	}
	if(isset($_SESSION['mess'])){
		$mess = $_SESSION['mess'];
	}else{
		$mess = '';
	}
	unset($_SESSION['mess']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Content/Styles/admin.css" rel='stylesheet' type='text/css' media="all" />
    <title>Buffalo Drive - Admin Login</title>
</head>
<body>
<form class="form-3" form action="" method="post">
    <p class="clearfix">
        <label for="login">Username</label>
        <input type="text" name="login" id="login" placeholder="Username">
    </p>
    <p class="clearfix">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password">
    </p>
    <p class="clearfix">
        <input type="submit" name="submit" value="Sign in">
    </p>
</form>
<p class="copyright">© 2020 Official Signup Form. All Rights Reserved.</p>
</body>
</html>