<?php
	if (isset($_POST["register"])) {
        //lấy thông tin từ các form bằng phương thức POST
        $firstname = $_POST["firstname"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		//Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
		if ($username == "" || $password == "" || $firstname == "" || $email == "") {
			echo "bạn vui lòng nhập đầy đủ thông tin";
		}else{
			$sql = "INSERT INTO user(username,pass,name,email) VALUES 
                    ('$username','$password','$firstname','$email')";
			// thực thi câu $sql với biến conn lấy từ file config.php
			mysqli_query($conn,$sql);
			echo "chúc mừng bạn đã đăng ký thành công";
		}
	}
?>