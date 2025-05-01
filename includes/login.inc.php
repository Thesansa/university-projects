<?php

//login.inc.php

if(isset($_POST["submit"])){

    $username=$_POST["uid"];
    $pwd=$_POST["pwd"];

    require_once 'dhb.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputLogin($username,$pwd) !== false){
        header("Location:../login.php?error=emptyinput");
        exit();
    }

    loginUSer($conn,$username, $pwd);
}
else{
    header('Location:../login.php');
    exit();
}

?>