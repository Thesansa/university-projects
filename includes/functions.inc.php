<?php

//functions.inc.php
function emptyInputRegister($username, $pwd, $email,  $repwd){

    $result=null;
    if(empty($username) || empty($email) || empty($pwd) || empty($repwd)){
        $result = true;
    }
    else{
        $result=false;
    }
    return $result;
}

function invalidUserName($username){

    $result=null;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
            $result =true;
    }
    else{
        $result=false;
    }
        return $result;
}

function invalidEmail($email){

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result =true;
    }
    else{
        $result=false;
    }
        return $result;

}

function pwdMatch($pwd, $repwd){

    if($pwd !== $repwd){
        $result =true;
    }
    else{
        $result=false;
    }
        return $result;
}

function userNameExists($conn, $username, $email){

    $sql="SELECT * FROM users WHERE userName = ? OR userEmail = ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location:../register.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $resultData= mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        return false;
    }
    mysqli_Stmt_close($stmt);
}

function createUser($conn, $username, $email, $pwd){

    $sql= "INSERT INTO users (userName, userEmail, userPwd) VALUES (?,?,?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location:../register.php?error=stmtFailed");
        exit();
    }

    $hashedpwd=password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedpwd);
    mysqli_stmt_execute($stmt);
    mysqli_Stmt_close($stmt);
    header("Location:../login.php?error=none");
    exit();

}
//login functions

function emptyInputLogin($username, $pwd){

    $result=null;
    if(empty($username) || empty($pwd)){
        $result = true;
    }
    else{
        $result=false;
    }
    return $result;
}

function loginUSer($conn,$username, $pwd){
    $uidexists=userNameExists($conn, $username, $username);
    if($uidexists==false){
        header("Location:../register.php?error=usernotfound");
        exit();
    }

    $hashedpwd=$uidexists["userPwd"];
    $checkpwd=password_verify($pwd, $hashedpwd);
    if($checkpwd===false){
        header("Location:../login.php?error=incorrectPassword");

        exit();
    }
    elseif($checkpwd===true){
        session_start();
        $_SESSION["userId"]=$uidexists["userId"];
        $_SESSION["userName"]=$uidexists["userName"];
        header("Location:../index.php");
        exit();
    }
}

//categories table conncetion creation(used function in index.php)
function getCategories($conn) {
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    return $result;
}



