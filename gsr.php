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
        <link rel="stylesheet" href="styles.css">
        <style>
            body{
                display:block;
                height: auto;
                justify-content: flex-start;
                align-items: stretch;
            }
            .addButton{
                position: relative;
                top: 75px;
                /* border: 1px black solid; */
                margin-bottom: 50px
            }
            .addButtonGSR{
                position: relative;
                left: 50%;
                transform: translate(-50%, 0);
            }
            button{
                position: relative;
                padding: 10px;
                border-radius: 20px;
                background-color: white;
                cursor: pointer;
                height: 100px;
            }
            .addSalesReport{
                /* none */
                position: relative;
                border: 1px white solid;
                width: 50%;
                height: auto;
                padding: 25px;
                background-color: wheat;
                border-radius: 50px;
                left: 50%;
                transform: translate(-50%, 0);
                top: 200px;
            }
            .addSalesReportHolder{
                display: none;
                z-index: 1;
                position: fixed;
                background-color: rgba(0, 0, 0, .5);
                width: 100%;
                height: 100vh;
                top: 0;
            }
            .closeButton {
                position: absolute;
                background-color: white;
                bottom: 0;
                left: 0px;
                height: 50px;
            }
            .midAddSalesReport{
                display: block;
                position: relative;
                /* background-color: red; */
                width: 100%;
                height: auto;
                padding-bottom: 50px;
            }
            .addToReportButton{
                position: absolute;
                right: 0;
                bottom: 0;
                border-radius: 20px;
                padding: 10px;
                background-color: white;
                height: 50px;
            }
            .addProductRowButton{
                position: relative;
                left: 50%;
                transform: translate(-50%, 0%);
                height: 50px;
                margin-bottom: 30px;
            }
            .addToReportProduct{
                background-color: white;
            }
            .productSelect{
                position: relative;
                width: fit-content;
                left: 50%;
                transform: translate(-50%, 0);
                margin-bottom: 20px;
            }
            .productSelect button{
                margin-right: 10px;
                padding: 5px;
                height: auto;
            }
            .productSelect select{
                border-radius: 20px;
                padding: 10px;
                margin-left: 10px;
                height: 50px;
            }
            .formDailySalesReport{
                position: relative;
                /* border: 1px black solid; */
                background-color: wheat;
                border-radius: 50px;
                top: 55px;
                width: 70%;
                left: 50%;
                transform: translate(-50%, 0);
            }
            .formDailySalesReport form{
                position: relative;

                width: 100%;
                left: 50%;
                transform: translate(-50%, 0);
            }
            .formDailySalesReport div{
                margin: 30px;
            }
            .formDailySalesReport button{
                margin-top: 20px;
                height: 40px;
            }
            .formDailySalesReport input{
                border-radius: 10px;
                height: 40px;
                margin: 10px;
                width: 70%;
            }
            .formDailySalesReport .subdiv{
                display: flex;
                /* border: 1px red solid; */
                height: auto;
                background-color: sandybrown;
                margin: 30px;
                border: 1px rgba(0, 0, 0, 1) solid;
                padding: 10px;
                border-radius: 20px;
            }
            #submitReport{
                position: relative;
                margin-left: 0px;
                margin-bottom: 50px;
                width: 50%;
                left: 50%;
                transform: translate(-50%, 10px);
                height: 50px;
            }
            .subdiv p{
                width: 30%;
            }
            .headersubdiv{
                display: flex;
                border: 0px;
            }
            .headersubdiv h2{
                position: absolute;
                left: 50%;
                transform: translate(-50%, 0px);
                width: 50%;
                text-align: center;
            }
            .gsrHeader{
                position: relative;
                /* border: 1px white solid; */
                top: 75px;
            }
            .gsrHeader h1{
                text-align: center;
                color: whitesmoke;
            }
        </style>
    </head>
    <body>
        <div class="gsrHeader">
            <h1>Generate Sales Report</h1>
        </div>
        <div class="addButton">
            <button class="addButtonGSR" onclick="showAdd()">ADD PRODUCT</button>
        </div>
        <?php
            include "addsalesreport.php";
            include "remove.php";
            include "navstaff.php";
        ?>
    </body>
    <script src="filtertable.js"></script>
    <script>
        var overlay = document.getElementById("addSalesReport");
        var addSalesReport = document.getElementById("addSalesReport");
        function showAdd(){
            addSalesReport.style.display = "block";
        }
        function closeAddSalesReport(){
            addSalesReport.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target === overlay) {
            overlay.style.display = 'none';
            }
        }
    </script>
</html>