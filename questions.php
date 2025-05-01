<?php
session_start();
include("includes/dhb.inc.php");
include("includes/functions.inc.php");

// Redirecting to login page if not logged in
if(!isset($_SESSION['userId'])){
    header("Location: login.php");
    exit();
}

// Getting question Id from URL
if(!isset($_GET['id']) || empty($_GET['id'])){
    echo "Invalid question ID.";
    exit();
}

$thread_id = $_GET['id'];

// Fetching question details
$sql = "SELECT * FROM threads WHERE Id=?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL error";
    exit();
}

mysqli_stmt_bind_param($stmt, "i", $thread_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$thread = mysqli_fetch_assoc($result);

if(!$thread){
    echo "Question not found.";
    exit();
}

// Getting answers under the chosen question, including the username from users table
$sql_answers = "SELECT posts.*, users.userName FROM posts JOIN users ON posts.user_id = users.userId WHERE thread_id=?";
$stmt_a = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt_a, $sql_answers)){
    echo "SQL error";
    exit();
}

mysqli_stmt_bind_param($stmt_a, "i", $thread_id);
mysqli_stmt_execute($stmt_a);
$answer_result = mysqli_stmt_get_result($stmt_a);

// Check if there are no answers
if(mysqli_num_rows($answer_result) == 0) {
    $no_qanswers_message = "No answers available for this question yet.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$thread['title']?> - Question</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="questions.css">
</head>
<body>
    <?php include("header.php"); ?>

    <div class="container mt-5">
        <h2 class="mb-4 thread-head"><?=$thread['title']?></h2>
        <a href="add_answer.php?thread_id=<?=$thread['id']?>" class="btn btn-success mb-4">Add Answer</a>
    </div>

    <h3 class="mt-5 h3">Answers for the question</h3>

    <!-- Check if there are no answers before displaying the answer list -->
    <?php if(isset($no_qanswers_message)) { ?>
        <div class="alert alert-info"><?= $no_qanswers_message ?></div>
    <?php } else { ?>
        <div class="row">
            <?php while($answer = mysqli_fetch_assoc($answer_result)) { ?>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="card-title" style="color:darkgray;">Answer by <?= htmlspecialchars($answer['userName']) ?> On <?=$answer['timestamp']?></h5>
                            <p class="card-text"><?= htmlspecialchars($answer['content']) ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

</body>
</html>
