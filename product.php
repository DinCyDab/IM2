<?php
    require_once 'utils.php';
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
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="scrollbarstyles.css">
        <style>
            body{
                display: block;
            }
            .addproductholder{
                display: none;
                width: 100%;
                height: 100vh;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, .5);
                padding: 20px;
                position: fixed;
                z-index: 2;
            }
            .add-product{
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
            .add-product div{
                border: 1px black solid;
                padding: 20px;
            }
            .add-product h4{
                margin: 0;
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
            .editproductholder{
                display: block;
                width: 100%;
                height: 100vh;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, .5);
                padding: 20px;
                position: fixed;
                z-index: 2;
            }
            .edit-product{
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
            .edit-product div{
                border: 1px black solid;
                padding: 20px;
            }
            .edit-product h4{
                margin: 0;
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
                <button id="remover" name="removeButton" value="product">REMOVE</button>
            </form>
            <form method="post">
                <button id="editor" name="editButton" value="product">EDIT</button>
            </form>
            <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Product...">
        </div>
        <div class="pageheader">
            <h1>Product Listing</h1>
        </div>
        <?php 
            include "addproduct.php";
            include "editproduct.php";
        ?>
    </body>
    <script src="filtertable.js"></script>
</html>

<?php
    $conn = mysqli_connect("localhost","root","","mamaflors");//connect db
    if($conn->connect_error){ //check for error connection
        die("ERROR". $conn->connect_error);
    }
    else{
        //retrieve list of products
        $sql = "SELECT * FROM product";
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
            //Create Table
            //a href='?' Sends a 'get' to server
            //? in href refers to query
            echo "
                <table id='table'>
                    <tr>
                        <th></th>
                        <th></th>
                        <th><a href='?sort=product_ID'>Product ID</a></th>
                        <th><a href='?sort=product_name'>Product Name</a></th>
                        <th><a href='?sort=product_description'>Product Description</a></th>
                        <th><a href='?sort=product_price'>Product Price</a></th>
                        <th><a href='?sort=product_status'>Product Status</a></th>
                    </tr>";
            for($x = 0; $x < sizeof($row); $x++){
                echo "<tr>
                        <td>
                            <form method='get'>
                                <input type='hidden' value='".($row[$x]['product_ID'])."' name='edit'>
                                <button class='edit-row' id='edit-row$x' type='submit'>EDIT</button>
                            </form>
                        </td>
                        <td>
                            <form method='get' action='remove.php'>
                                <input type='hidden' value='".($row[$x]['product_ID'])."' name='removeID'>
                                <input type='hidden' value='product' name='tableName'>
                                <input type='hidden' value='product_ID' name='columnName'>
                                <button class='remove-row' id='remove-row$x' name='remove'>Remove</button>
                            </form>
                        </td>
                        <td>".$row[$x]["product_ID"]."</td>
                        <td>".$row[$x]['product_name']."</td>
                        <td>".$row[$x]['product_description']."</td>
                        <td>".$row[$x]['product_price']."</td>
                        <td>".$row[$x]['product_status']."</td>
                    </tr>";
            }
            echo "</table>";
        }
        else{
            echo "EMPTY DATABASE";
        }
    }
    $conn->close(); //close db connection
    include "navadmin.php";
?>

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