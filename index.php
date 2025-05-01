<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="index.css">
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    session_start();
    include("includes/dhb.inc.php");
    include("includes/functions.inc.php");

    $result = getCategories($conn);


    // Check if the user is logged in
    if (!isset($_SESSION['userId'])) {
        header("Location: login.php");
        exit();
    }

    // Fetch categories from the database
    $query = "SELECT * FROM categories";
    $result = mysqli_query($conn, $query);
    ?>

    <article class="article">

        <?php include("header.php"); ?>
        <div class="home">
            <h2 class="welcome">Welcome...</h2>
            <!-- Show user name if logged in -->
            <h1 id="user">Hello <?php echo isset($_SESSION["userName"]) ? $_SESSION["userName"] : "User"; ?> !</h1>
            <p class="intro">
                Our web forum is a dynamic and interactive platform designed for developers, tech enthusiasts,
                and learners to come together, share knowledge, and solve problems. Whether you're a beginner exploring
                HTML basics or an experienced developer diving into advanced topics like AI integration or backend optimization,
                our forum offers a space for meaningful discussion, collaboration, and growth.<br>
                Users can ask questions, provide answers, showcase projects, and stay updated on the latest trends in web development,
                UI/UX, programming languages, and emerging technologies. With a clean interface and helpful categories, our goal
                is to build a supportive community that helps everyone grow — one post at a time.
            </p>
        </div>

        <?php
        


        ?>

        <!-- Display Categories -->
        <h2 class="cat-head">Categories</h2>
        <div class="container mt-4">
            <div class="row">
                <?php while ($category = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-4">
                    <div class="card mb-3 custom-border">
                            <div class="card-body">
                                <h5 class="card-title"><?= $category['Name'] ?></h5>
                                <p class="card-text"><?= $category['Description'] ?></p>
                                <a href="category.php?id=<?= $category['Id'] ?>" class="btn btn-primary">View Category</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </article>

    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>