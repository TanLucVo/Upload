<?php
    require_once '../function.php';
    require_once '../config.php';
    session_start();
    $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
    $salt = sprintf("$2y$%02d$", 10) . $salt; //$2y$ là thuật toán BlowFish, 10 là độ dài của key mã hóa.
    if (!isset($_SESSION['user']) || !isset($_SESSION['name'])) {
        header('Location: ./views/login.php');
    } else {
        $user = $_SESSION['user'];
        $name = $_SESSION['name'];
    }
    if (isset($_POST["username"]) && isset($_POST["pass"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"])) {
        //lấy thông tin từ các form bằng phương thức POST
        //bcrypt

        
        $username = $_POST["username"];
        $pass = crypt($_POST["pass"], $salt);
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        editProfile($username, $pass, $firstname, $lastname, $email, $conn);
        echo json_encode(array('status' => true, 'data' => 'Updated'));
    }
    else{
        echo json_encode(array('status' => false, 'data' => 'Parameters not valid'));
    }
?>
