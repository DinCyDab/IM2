<?php
    require_once 'utils.php';
    ob_start();
    session_start();
    if(!isset($_SESSION["loggedin"])){
        header ("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            .addSalesReport{
                display: none;
            }
        </style>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <a href="indexstaff.php">Back</a>
        <br>
        <button onclick="showAdd()">ADD PRODUCT</button>
        <?php
            include "addsalesreport.php";
            include "remove.php";
            include "navstaff.php";
        ?>
    </body>
    <script src="filtertable.js"></script>
    <script>
        var addSalesReport = document.getElementById("addSalesReport");
        function showAdd(){
            addSalesReport.style.display = "block";
        }
        function closeAddSalesReport(){
            addSalesReport.style.display = "none";
        }
    </script>
</html>