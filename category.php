<?php
session_start();
include("includes/dhb.inc.php");
include("includes/functions.inc.php");

//redirecting to login page if not logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

//getting category Id from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid category ID.";
    exit();
}

$category_id = $_GET['id'];

//fetching category details
$sql = "SELECT * FROM categories WHERE Id=?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL error";
    exit();
}
mysqli_stmt_bind_param($stmt, "i", $category_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$category = mysqli_fetch_assoc($result);

if (!$category) {
    echo "Category not found.";
    exit();
}

//getting questions under the chosen category
$sql_questions = "SELECT threads.*,users.userName FROM threads JOIN users ON threads.user_id = users.userId WHERE category_id=?";
$stmt_q = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_q, $sql_questions)) {
    echo "SQL error";
    exit();
}
mysqli_stmt_bind_param($stmt_q, "i", $category_id);
mysqli_stmt_execute($stmt_q);
$questions_result = mysqli_stmt_get_result($stmt_q);

// Check for no questions
if (mysqli_num_rows($questions_result) == 0) {
    $no_questions_message = "No questions available in this category yet.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $category['Name'] ?> - Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="category.css">
</head>

<body>

    <?php include("header.php"); ?>

    <div class="container mt-5 ">
        <div class="categ">
            <h2 class="mb-4 cat-head"><?= $category['Name'] ?></h2>
            <p><?= $category['Description'] ?></p>
            <a href="add_question.php?category_id=<?= $category['Id'] ?>" class="btn btn-success mb-4">Add Question</a>
        </div>
        <h3 class="mt-5 h3">Questions in this Category</h3>

        <?php if (isset($no_questions_message)) { ?>
            <div class="alert alert-info"><?= $no_questions_message ?></div>
        <?php } else { ?>
            <div class="row">
                <?php while ($question = mysqli_fetch_assoc($questions_result)) { ?>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 style="color:darkgray;">question by <?=$question['userName']?> On <?=$question['timestamp']?> </h6>
                                <h5 class="card-title"><?= htmlspecialchars($question['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($question['body']) ?></p>
                                <a href="questions.php?id=<?= $question['id'] ?>" class="btn btn-primary">View Question</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

</body>

</html>