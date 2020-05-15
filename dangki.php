<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./views/register.php" method="post">
        <input type="text" id="firstname" name="firstname" placeholder="First Name" title="Please enter your First Name" required="">

        <input type="text" id="lastname" name="lastname" placeholder="Last Name" title="Please enter your Last Name" required="">

        <input type="text" id="username" name="username" placeholder="User Name" title="Please enter your User Name" required="">

        <input type="email" id="email" name="email" placeholder="mail@example.com" title="Please enter a valid email" required="">


        <input type="password" class="lock" name="password" placeholder="Password" id="password1" required="">

        <input type="password" class="lock" name="confirm-password" placeholder="Confirm Password" id="password2" required="">

        <input type="submit" class="register" name="register" value="Register">
    </form>
</body>

</html>