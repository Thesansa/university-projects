<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Now!</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>

<?php

include("header.php");
?>

    <form class="register" method="post" action="includes/register.inc.php" id="registerForm">
        <header id="hregister">Register Here</header>

        <label class="label" for="uname">Username :</label>
        <input class="input" type="text" id="uname" name="usid" required>

        <label class="label" for="email">E-mail:</label>
        <input class="input" type="email" id="email" name="email" required>

        <label class="label" for="pword">Password :</label>
        <input class="input" type="password" name="pswd" id="pword" required>

        <label class="label" for="re-pword">Re-enter the password :</label>
        <input class="input" type="password" name="repwd" id="re-pword" required>

        <p id="correctp">Password confirmation done</p>
        <p id="wrongp">Password confirmation error, please re-enter the correct password</p>

        <button type="submit" id="registerbtn" name="submit" disabled>Register</button>

        <p id="loginnow">Already have an account? <a id="loglink" href="login.php">Click to Log In</a></p>
    </form>

    <?php
     if(isset($_GET["error"])){
        if($_GET["error"]=="emptyinput"){
            echo'<div class="error">Fill in all the fields</div>';
        }
        elseif($_GET["error"]=="invalidUserName"){
            echo'<div class="error">Invalid user name</div>';
        }
        elseif($_GET["error"]=="invalidEmail"){ 
            echo'<div class="error">Invalid email</div>';
        }
        elseif($_GET["error"]=="passwordsarenotmatching"){
            echo'<div class="error">Passwords are not matching</div>';
        }
        elseif($_GET["error"]=="userNameTaken"){
            echo'<div class="error">User name has already been taken</div>';
        }
        elseif($_GET["error"]=="stmtFailed"){
            echo'<div class="error">Something went wrong!</div>';
        }
     }
?>

    <script src="register.js"></script>

</body>
</html>
