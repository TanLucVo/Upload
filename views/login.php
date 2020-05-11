<?php 
    include('../function.php');
    session_start();
    require_once('../config.php');
    $mess='';
    if(isset($_POST['user']) && $_POST['pass']){
        $result = login($_POST['user'], $_POST['pass'],$conn);
        if($result == null){
            $mess = 'Sai mk';
        }
        else{
            $_SESSION['name'] = $_POST['user'];
            header('Location: ../');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">
        <input type="text" name="user" id="user">
        <input type="text" name="pass" id="pass">
        <p><?= $mess?></p>
        <input type="submit" value="submit">
    </form>
</body>

</html>