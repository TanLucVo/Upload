<?php
	include('../function.php');
	session_start();
	require_once('../config.php');
	$mess = '';
	if (isset($_POST['login']) && $_POST['password']) {
		$result = adminlogin($_POST['login'], $_POST['password'], $conn);
		if ($result == null) {
			$mess = 'Wrong password';
			unset($_POST);
		} else {
			$_SESSION['account_admin'] = $result['username'];
			$_SESSION['user']='admin';
			$_SESSION['name'] = 'admin';
			header('Location: ../adminpage.php');
		}
	}

	
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
<h1 class="login_admin">Admin Login</h1>
<form class="form-3" form action="" method="post">
    <p class="clearfix">
        <label for="login">Username</label>
        <input type="text" name="login" id="login" placeholder="Username" required>
    </p>
    <p class="clearfix">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
	</p>
	<p style="color: red;"><?=$mess ?></p>
    <p class="clearfix">
        <input type="submit" name="submit" value="Sign in">
    </p>
</form>
<p class="copyright">© 2020 Official Admin Login Form. All Rights Reserved.</p>
</body>
</html>