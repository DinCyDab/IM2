<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            .addSalesReport{
                display: none;
            }
        </style>
    </head>
    <body>
        <a href="indexstaff.php">Back</a>
        <br>
        <button onclick="showAdd()">ADD PRODUCT</button>
        <?php
            include "addsalesreport.php";
            include "remove.php"
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