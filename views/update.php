<?php
    require_once '../function.php';
    require_once '../config.php';
    session_start();
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
        $pass = password_hash($_POST["pass"], PASSWORD_BCRYPT);
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
