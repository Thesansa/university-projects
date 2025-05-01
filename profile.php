<?php
session_start(); 

if (isset($_SESSION["userName"])) {
    echo '
    <a href="includes/logout.inc.php">
        <button style="
            padding: 10px;
            margin:10px;
            background-color: #007bff;
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
            border: none;
            border-radius: 10px;
        ">Logout</button>
    </a>';
}
?>
