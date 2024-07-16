<?php
    require_once 'utils.php';
    ob_start();
    session_start();
    if(isset($_SESSION["loggedin"])){
        if($_SESSION["role"] != "Administrator"){
            header("Location: indexstaff.php");
            exit();
        }
        if($_SESSION["role"] == "Administrator" || $_SESSION["role"] == "Owner"){
            header("Location: indexadmin.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mama Flor's Lechon House</title>
        <link rel="stylesheet" href="styles.css">
        <style>
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
        <div class="grid-40-60">
            <div>
                <img src="imagesources/logo.png" alt="Mamaflors Logo">
            </div>
            <div>
                <form method="post" class="signin">
                    <span>Sign in</span>
                    <input type="text" id="accountID" name="accountID" placeholder="Account ID" required>
                    <input type="password" id="password" name="password" placeholder="Password">
                    <button name="signin">Sign in</button>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
    if(isset($_POST["signin"])){
        $accountID = $_POST["accountID"];
        $pass = $_POST["password"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if(!$conn->connect_error){
            $sql = "SELECT
                        *
                    FROM
                        account
                    WHERE
                        account_ID = '$accountID'
            ";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            $conn->close();
            if($row[0]["account_status"] == "Inactive"){
                include "errorfolder/loginerror.php";
            }
            else if(sizeof($row) > 0 && password_verify($pass, $row[0]["password"])){
                $_SESSION["account_ID"] = $row[0]["account_ID"];
                $_SESSION["pass"] = $pass;
                header("Location: authentication.php");
                exit();
            }
        }
    }
?>

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