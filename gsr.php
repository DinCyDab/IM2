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
                background-color: wheat;
                height: 70px;
                border-radius: 100px;
                font-family: fantasy;
                color: brown;
                font-size: 20px;
                letter-spacing: 3px;
                padding-left: 20px;
                padding-right: 20px;
                box-shadow: 0px 0px 20px 0px wheat;
                border: 10px solid;
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
                height: auto;
                background-color: indianred;
                box-shadow: 0px 0px 20px 0px indianred;
                color: brown;
                font-family: fantasy;
                font-size: 20px;
                height: auto;
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
                /* background-color: white; */
                height: 50px;
                background-color: lightgreen;
                box-shadow: 0px 0px 20px 0px lightgreen;
                color: green;
                font-family: fantasy;
                font-size: 20px;
                height: auto;
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
                top: -50px;
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
                background-color: crimson;
                box-shadow: 0px 0px 20px 0px crimson;
                color: white;
                font-size: 15px;
                font-family: fantasy;
                letter-spacing: 1px;
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
                border-radius: 30px;
                box-shadow: 0px 0px 20px 2px brown;
                background-color: lightgreen;
                color: green;
                font-size: 20px;
                font-family: fantasy;
                letter-spacing: 3px
            }
            .subdiv p{
                width: 30%;
                font-family: system-ui;
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
                font-family: cursive;
                font-size: 30px;
                color: brown;
            }
            .gsrHeader{
                position: relative;
                /* border: 1px white solid; */
                top: 75px;
            }
            .gsrHeader h1{
                text-align: center;
                color: whitesmoke;
                font-family: cursive;
            }
            .errorMsgHolder{
                position: fixed;
                width: 100%;
                height: 100vh;
                background-color: rgba(0, 0, 0, .4);
                top: 0px;
                z-index: 1;
            }
            .errorMSG{
                position: relative;
                width: 30%;
                height: auto;
                color: white;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                background-color: wheat;
                border-radius: 20px;
                padding: 20px;
            }
            .errorMSG h1{
                color: red;
            }
            .errorMSG p{
                color: black;
                text-decoration: underline;
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
        var errorMsg = document.getElementById("errorMsg");
        var errorMsg1 =document.getElementById("errorMsg1");
        var addSalesReport = document.getElementById("addSalesReport");
        function showAdd(){
            addSalesReport.style.display = "block";
        }
        function closeAddSalesReport(){
            addSalesReport.style.display = "none";
        }
        window.onclick = function(event) {
            if(event.target == overlay) {
                overlay.style.display = 'none';
            }
            if(event.target == errorMsg){
                errorMsg.style.display = 'none';
            }
            if(event.target == errorMsg1){
                errorMsg.style.display = 'none';
            }
        }
    </script>
</html>