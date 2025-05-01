<?php

//dhb.inc.php

    $servername="localhost";
    $password="";
    $uname="root";
    $dbname="web_forum";

    $conn=mysqli_connect($servername, $uname, $password, $dbname);
    if(!$conn){
        die("Connection failed : " . mysqli_connect_error());
    }
    
?>