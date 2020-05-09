<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
        if (empty($user) || empty($pass)) {
            echo 1;
        } else {
            echo "$user va $pass";
        }


    ?>
    <form action="./" method="post">
        <input type="text" name="user" id="user">
        <input type="text" name="pass" id="pass">
        <input type="submit" value="submit">
    </form>
</body>

</html>