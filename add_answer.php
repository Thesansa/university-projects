<?php

session_start();

include("includes/dhb.inc.php");
include("includes/functions.inc.php");

if(!isset($_SESSION['userId'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit'])){
    $thread_id=$_POST['thread_id'];
    $user_id=$_SESSION['userId'];
    $content=$_POST['content'];

//inserting new answer to the 'post' table
$sql= "INSERT INTO posts (thread_id, user_id, content) VALUES (?,?,?)";
$stmt=mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo"SQL error";
    exit();
}
mysqli_stmt_bind_param($stmt, "iis", $thread_id, $user_id, $content);
mysqli_stmt_execute($stmt);

//Rederecting to question page
header("Location: questions.php?id=".$thread_id);
exit();

}

$thread_id=$_GET['thread_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Answer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <?php include("header.php")?>
    <div class="container mt-5">
        <h2>Add a new Answer</h2>
        <form action="add_answer.php?thread_id=<?=$thread_id?>" method="post">
            <div class="form-group">
                <label for="content">Answer Body</label>
                <input type="text" name="content" id="content" class="form-control" required>
            </div>
            <input type="hidden" name="thread_id" value="<?=$thread_id?>">
            <button type="submit" name="submit" class="btn btn-primary">Submit answer</button>

        </form>
    </div>
    
</body>
</html>


