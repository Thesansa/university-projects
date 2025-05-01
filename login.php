<!DOCTYPE html>
<!--login.php-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>

    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="index.css">
</head>

<body>
<?php

    include("header.php");
 ?>
 
    <div class="login-box">
        <form class="login" action="includes/login.inc.php" method="post">

            <header id="hlogin">Log In</header>
            <label class="label" for id="uname">Username :</label>
            <input class="input" type="text" name="uid" id="uname" required>

            <label class="label" for id="pword">Password :</label>
            <input class="input" type="password" id="pword" name="pwd" required>

            <button name="submit" type="submit" id="loginbtn">Log In</button>

            <p id="registernow">New to the site?   <a id="reglink" href="register.php">Click to register</a></p>
            

        </form>
    </div>



</body>

</html>