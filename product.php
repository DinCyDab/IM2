<!DOCTYPE html>
<html>
    <head>
        <style>
            .add-product{
                display: none;
            }
            .remove-product{
                display: none;
            }
            .edit-product{
                display: block;
            }
            .edit-product-row{
                display: none;
            }
            /* table design */
            table{
                border-collapse: collapse;
            }
            th, tr{
                border: 1px aqua solid;
            }
            tr:nth-child(even){
                background-color: aqua;
            }
        </style>
    </head>
    <body>
        <a href="index.php">Home</a>

        <br>

        <button onclick="showAddProduct()">ADD</button>
        <button id="remover">REMOVE</button>
        <button id="editor">EDIT</button>

        <br>
        
        <?php 
            include "addproduct.php";
            include "editproduct.php";
        ?>
    </body>
    <script>
        //add onclick remove button
        var remover = document.getElementById("remover");
        remover.addEventListener("click", showRemoveProduct);

        var editor = document.getElementById("editor");
        editor.addEventListener("click", showEditProduct);

        function showAddProduct(){
            document.getElementById("add-product").style.display = "block";
        }

        function showEditProduct(){
            var editButton = document.getElementsByClassName("edit-product-row");
            for(var i = 0; i < editButton.length; i++){
                document.getElementById("edit-product-row"+i).style.display = "block";
            }
            editor.removeEventListener("click", showEditProduct);
            editor.addEventListener("click", hideEditProduct);
        }

        function hideEditProduct(){
            var editButton = document.getElementsByClassName("edit-product-row");
            for(var i = 0; i < editButton.length; i++){
                document.getElementById("edit-product-row"+i).style.display = "none";
            }
            editor.removeEventListener("click", hideEditProduct);
            editor.addEventListener("click", showEditProduct);
        }

        function showRemoveProduct(){
            var removeButton = document.getElementsByClassName("remove-product");
            for(var i = 0; i < removeButton.length; i++){
                document.getElementById("remove-product"+i).style.display = "block";
            }
            remover.removeEventListener("click", showRemoveProduct);
            remover.addEventListener("click", hideRemoveProduct);
        }

        function hideRemoveProduct(){
            var removeButton = document.getElementsByClassName("remove-product");
            for(var i = 0; i < removeButton.length; i++){
                document.getElementById("remove-product"+i).style.display = "none";
            }
            remover.removeEventListener("click", hideRemoveProduct);
            remover.addEventListener("click", showRemoveProduct);
        }
    </script>
</html>

<?php
    $conn = mysqli_connect("localhost","root","","mamaflors");//connect db
    if($conn->connect_error){ //check for error connection
        die("ERROR". $conn->connect_error);
    }
    else{
        //retrieve list of products
        $sql = "SELECT * FROM product";

        //checks for user input
        if(isset($_GET["sort"])){
            $sortColumn = $_GET["sort"];
            $sql .= " ORDER BY $sortColumn";
        }

        $result = $conn->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if($result->num_rows > 0){
            //Create Table
            //a href='?' Sends a 'get' to server
            //? in href refers to query
            echo "
                <table>
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
                                <button class='edit-product-row' id='edit-product-row$x' type='submit'>EDIT</button>
                            </form>
                        </td>
                        <td><form method='get'>
                                <input type='hidden' value='".($row[$x]['product_ID'])."' name='remove'>
                                <button class='remove-product' id='remove-product$x'>Remove</button>
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
?>

<?php 
    if(isset($_GET["remove"])){
        $removevalue = $_GET["remove"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "DELETE FROM product
                    WHERE product_ID = $removevalue";
            $conn->query($sql);
        }
        $conn->close();
        echo "<a href='product.php'>Back To Product</a>";
    }
?>