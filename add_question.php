<?php
session_start();
include("includes/dhb.inc.php");
include("includes/functions.inc.php");

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category_id = $_POST['category_id'];

    // Insert the new question into the database
    $sql = "INSERT INTO threads (title, body, category_id, user_id) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssii", $title, $body, $category_id, $_SESSION['userId']);
    mysqli_stmt_execute($stmt);

    // Redirect back to the category page
    header("Location: category.php?id=" . $category_id);
    exit();
}

$category_id = $_GET['category_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include("header.php"); ?>
    <div class="container mt-5">
        <h2>Add a New Question</h2>
        <form action="add_question.php?category_id=<?= $category_id ?>" method="POST">
            <div class="form-group">
                <label for="title">Question Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="body">Question Body</label>
                <textarea name="body" id="body" class="form-control" rows="5" required></textarea>
            </div>
            <input type="hidden" name="category_id" value="<?= $category_id ?>">
            <button type="submit" name="submit" class="btn btn-primary">Submit Question</button>
        </form>
    </div>
</body>
</html>
