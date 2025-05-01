
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="stylesheet" href="header.css?v=1.1">
</head>

<body>

    <div class="navbar">
        <div class="webname">Geeks</div>
        <ul class="navbar-links">
            <li><a href="index.php" class="nav-links" id="active">Home</a></li>
            <li><a href="#" class="nav-links">About</a></li>
            <li><a href="#" class="nav-links">Contact</a></li>
            <li>
                <?php
                    if(isset($_SESSION["userName"])){
                        echo'<a class="nav-links" href="profile.php">'.$_SESSION["userName"]."</a>";

                    }
                    else{
                        echo'<a class="nav-links" href="login.php">Profile</a>';
                    }
                    
                ?>
            </li>
        </ul>
    </div>

</body>

</html>

