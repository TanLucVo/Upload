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
			$_SESSION['mess'] = $mess;
			unset($_POST);
			header('Location: ../signup.php');
		}else{
			unset($_POST);
			register($username,$password,$name,$email, $conn);
			
			header('Location: ./login.php');
		}
	}
?>