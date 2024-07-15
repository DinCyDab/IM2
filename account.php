<?php
    ob_start();
    session_start();
    if($_SESSION["role"] != "Administrator"){
        header("Location: indexstaff.php");
    }
    if(!isset($_SESSION["session_started"])){
        $_SESSION["session_started"] = TRUE;
        $_SESSION["showEdit"] = FALSE;
        $_SESSION["showRemove"] = FALSE;
    }
    if(!isset($_SESSION["SORT"])){
        $_SESSION["SORT"] = "DESC";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="scrollbarstyles.css">
        <link rel="stylesheet" href="styles.css">
        <style>
            body{
                display: block;
            }
            .remove-row{
                display: <?php
                        if(isset($_SESSION["showRemove"])){
                            if($_SESSION["showRemove"] == TRUE){
                                echo "block";
                            }
                            else{
                                echo "none";
                            }
                        }
                        else{
                            echo "none";
                        }
                    ?>;
            }
            .edit-row{
                display: <?php
                        if(isset($_SESSION["showEdit"])){
                            if($_SESSION["showEdit"] == TRUE){
                                echo "block";
                            }
                            else{
                                echo "none";
                            }
                        }
                        else{
                            echo "none";
                        }
                    ?>;
            }
            .edit-product{
                display: block;
            }
            .functionalitybuttons{
                /* border: 1px black solid; */
                top: 100px;
                display: flex;
                /* width: fit-content; */
                justify-content: center;
                align-items: center;
                padding: 10px;
                position: fixed;
                left: 50%;
                transform: translate(-50%, 0);
            }
            .functionalitybuttons button{
                padding: 10px;
                margin-left: 10px;
                margin-right: 10px;
                border-radius: 10px;
                background-color: white;
            }
            .functionalitybuttons input{
                padding: 10px;
                margin-left: 10px;
                margin-right: 10px;
                border-radius: 10px;
            }
            .addaccountholder{
                display: none;
                width: 100%;
                height: 100vh;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, .5);
                padding: 15px;
                position: fixed;
                z-index: 2;
            }
            .add-account{
                position: relative;
                background-color: wheat;
                width: fit-content;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                border: none;
                border-radius: 20px;
                box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.50);
            }
            .add-account div{
                border: 1px black solid;
                padding: 15px;
            }
            .add-account h4{
                margin: 0;
            }
            .add-account-form div{
                display: flex;
            }
            .editaccountholder{
                display: block;
                width: 100%;
                height: 100vh;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, .5);
                padding: 15px;
                position: fixed;
                z-index: 2;
            }
            .edit-account{
                position: relative;
                background-color: wheat;
                width: fit-content;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                border: none;
                border-radius: 20px;
                box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.50);
            }
            .edit-account div{
                border: 1px black solid;
                padding: 15px;
            }
            .edit-account h4{
                margin: 0;
            }
            .edit-account-form div{
                display: flex;
            }
            /* .add-account{
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                background-color: wheat;
                padding: 20px;
                width: fit-content;
                border-radius: 5px;
                box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.50);
                position: relative;
                border: none;
            }
            .addaccountholder{
                display: none;
                position: fixed;
                width: 100%;
                background-color: rgba(0, 0, 0, .5);
                height: 100vh;
                top: 0;
                z-index: 2;
            }
            .button-close {
                position: absolute;
                top: 10px;
                right: 10px;
                background: none;
                border: none;
                font-size: 1.2em;
                cursor: pointer;
            }
            .addaccountform{
                margin-top: 20px;
                display: block;
            }
            .addaccountform div{
                border: 1px black solid;
                display: flex;
                padding: 10px;
            }
            .addaccountform h2{
                font-size: 20px;
                width: fit-content;
                border: 1px red solid;
            }
            .addaccountform select{
                position: relative;
                border: 1px green solid;
                height: fit-content;
                top: 50%;
                padding: 10px;
                border-radius: 20px;
                transform: translate(0, -50%);
            }
            .subdiv{
                height: fit-content;
                padding: 10px;
                border-radius: 50px;
                position: relative;
                top: 50%;
                transform: translate(0, -50%);
            }
            .submitHolder{
                border: 1px black solid;
            }
            .submitHolder input{
                position: relative;
                left: 50%;
                transform: translate(-50%, 0);
                padding: 10px;
                border-radius: 15px;
                width: 50%;
            }
            .headerholder{
                border: 1px black solid;
                margin-top: 20px;
            }
            .headerholder h1{
                text-align: center;
                margin: 0;
            }
            .editaccountform{
                margin-top: 20px;
                display: block;
            }
            .editaccountform div{
                display: flex;
            }
            .editaccountform select{
                position: relative;
                height: fit-content;
                top: 50%;
                transform: translate(0%, -50%);
                padding: 10px;
                border-radius: 20px;
            } */
            table{
                display: flex;
                position: relative;
                align-items: center;
                justify-content: center;
                margin-top: 120px;
                width: fit-content;
                top: 40px;
                left:50%;
                transform: translate(-50%, 0);
            }
            table th{
                background-color: sandybrown;
            }
            table a{
                color: brown;
            }
            table tr{
                background-color: brown;
                color: wheat;
                text-align: center
            }
            table tr:nth-child(even){
                background-color: wheat;
                color: brown;
            }
            .pageheader{
                position: relative;
                /* border: 1px black solid; */
                top: 140px;
                left: 50%;
                transform: translate(-50%, 0);
                z-index: -1;
            }
            .pageheader h1{
                color: wheat;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="functionalitybuttons">
            <button onclick="showAdd()">ADD</button>
            <form method="post">
                <button id="remover" name="removeButton" value="account">REMOVE</button>
            </form>
            <form method="post">
                <button id="editor" name="editButton" value="account">EDIT</button>
            </form>
            <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Account...">
        </div>
        <div class="pageheader">
            <h1>Accounts</h1>
        </div>
        <?php
            include "addaccount.php";
            include "remove.php";
            include "editaccount.php";
            include "navadmin.php";
        ?>
        <?php
            //Retrieve account sql
            $conn = mysqli_connect("localhost","root","","mamaflors");
            if($conn->connect_error){
                die("ERROR". $conn->connect_error);
            }
            else{
                $sql = "SELECT
                            account.*,
                            staff.last_name,
                            staff.first_name,
                            staff.middle_name
                        FROM
                            account
                            INNER JOIN staff ON account.account_ID = staff.staff_ID
                        ";
                if(isset($_GET["sort"])){
                    if($_SESSION["SORT"] == "DESC"){
                        $_SESSION["SORT"] = "ASC";
                    }
                    else{
                        $_SESSION["SORT"] = "DESC";
                    }
                    $sql .= " ORDER BY " . $_GET["sort"] . " " . $_SESSION["SORT"];
                }
                $result = $conn->query($sql);
                $row = $result->fetch_all(MYSQLI_ASSOC);
                if(sizeof($row) > 0){
                    echo "<table id='table'>
                        <tr>
                            <th></th>
                            <th></th>
                            <th><a href='?sort=account_ID'>Account ID</a></th>
                            <th><a href='?sort=last_name'>Last Name</a></th>
                            <th><a href='?sort=first_name'>First Name</a></th>
                            <th><a href='?sort=middle_name'>Middle Name</a></th>
                            <th><a href='?sort=role'>Role</a></th>
                            <th><a href='?sort=account_status'>Account Status</a></th>
                        </tr>
                    ";
                    for($x = 0; $x < sizeof($row); $x++){
                        echo "
                            <tr>
                                <td>
                                    <form method='get'>
                                        <input type='hidden' value='".($row[$x]['account_ID'])."' name='edit'>
                                        <button class='edit-row' id='edit-row$x' type='submit'>EDIT</button>
                                    </form>
                                </td>
                                <td>
                                    <form method='get' action='remove.php'>
                                        <input type='hidden' value='".($row[$x]['account_ID'])."' name='removeID'>
                                        <input type='hidden' value='account' name='tableName'>
                                        <input type='hidden' value='account_ID' name='columnName'>
                                        <button class='remove-row' id='remove-row$x' name='remove'>Remove</button>
                                    </form>
                                </td>
                                <td>".$row[$x]["account_ID"]."</td>
                                <td>".$row[$x]["last_name"]."</td>
                                <td>".$row[$x]["first_name"]."</td>
                                <td>".$row[$x]["middle_name"]."</td>
                                <td>".$row[$x]["role"]."</td>
                                <td>".$row[$x]["account_status"]."</td>
                            </tr>
                        ";
                    }
                    echo "</table>";
                }
                else{
                    echo "EMPTY DATABASE";
                }
            }
            $conn->close();
        ?>
        
    </body>
    <script src="filtertable.js"></script>
    <script>
        var add = document.getElementById("add");
        var edit = document.getElementById("edit");
        window.onclick = function(event) {
            if(event.target == add){
                add.style.display = 'none';
            }
            if(event.target == edit){
                edit.style.display = 'none';
            }
        }
    </script>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editButton"])){
        $pageName = $_POST["editButton"];
        if($_SESSION["showEdit"] == FALSE){
            $_SESSION["showEdit"] = TRUE;
        }
        else{
            $_SESSION["showEdit"] = FALSE;
        }
        header("Location:$pageName.php");
        exit();
    }
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["removeButton"])){
        $pageName = $_POST["removeButton"];
        if($_SESSION["showRemove"] == FALSE){
            $_SESSION["showRemove"] = TRUE;
        }
        else{
            $_SESSION["showRemove"] = FALSE;
        }
        header("Location:$pageName.php");
        exit();
    }
?>