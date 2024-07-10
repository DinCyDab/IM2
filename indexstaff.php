<?php
    require_once 'utils.php';
    session_start();
    if(!isset($_SESSION["loggedin"])){
        header ("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php 
            include "navstaff.php";
        ?>
    </body>
</html>