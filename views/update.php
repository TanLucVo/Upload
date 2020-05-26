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

    if (isset($_POST["username"]) && isset($_POST["pass"]) && isset($_POST["name"]) && isset($_POST["email"])) {
        //lấy thông tin từ các form bằng phương thức POST
        $username = $_POST["username"];
        $pass = $_POST["pass"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        editProfile($username, $pass, $name, $email, $conn);
        echo json_encode(array('status' => true, 'data' => 'Updated'));
    }
    else{
        echo json_encode(array('status' => false, 'data' => 'Parameters not valid'));
    }
?>
