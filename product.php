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
        <style>
            .add-product{
                display: none;
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
            .edit-product{
                display: block;
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
        </style>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <a href="indexadmin.php">Home</a>

        <br>

        <button onclick="showAdd()">ADD</button>
        <form method="post">
            <button id="remover" name="removeButton" value="product">REMOVE</button>
        </form>
        <form method="post">
            <button id="editor" name="editButton" value="product">EDIT</button>
        </form>
        <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Product...">

        <br>
        
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
                        <td><form method='get' action='remove.php'>
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