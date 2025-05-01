<?php
//register.inc.php
if(isset($_POST["submit"])){
    $username=$_POST["usid"];
    $pwd=$_POST["pswd"];
    $email=$_POST["email"];
    $repwd=$_POST["repwd"];

    require_once 'dhb.inc.php';
    require_once 'functions.inc.php';

    $emptyInput=emptyInputRegister($username, $pwd, $email,  $repwd);
    $invalidUserName= invalidUserName($username);
    $invalidEmail= invalidEmail($email);
    $pwdMatch=pwdMatch($pwd, $repwd);
    $userNameExists= userNameExists($conn, $username, $email);

    if($emptyInput !== false){
        header("Location:../register.php?error=emptyinput");
        exit();
    }

    if($invalidUserName !== false){
        header("Location:../register.php?error=invalidUserName");
        exit();
    }

    if($invalidEmail !== false){
        header("Location:../register.php?error=invaildEmail");
        exit();
    }

    if($pwdMatch !== false){
        header("Location:../register.php?error=passwordsarenotmatching");
        exit();
    }

    if($userNameExists !== false){
        header("Location:../register.php?error=userNameTaken");
        exit();
    }

    createUser($conn, $username, $email, $pwd);

}

else{
    header('Location:../login.php');
    exit();
}

?>
