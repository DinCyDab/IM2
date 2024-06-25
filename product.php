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
        <button>EDIT</button>

        <br>
        
        <?php 
            include "addproduct.php";
        ?>
    </body>
    <script>
        var button = document.getElementById("remover");
        button.addEventListener("click", showRemoveProduct);

        function showAddProduct(){
            document.getElementById("add-product").style.display = "block";
        }

        function showRemoveProduct(){
            var removeButton = document.getElementsByClassName("remove-product");
            for(var i = 0; i < removeButton.length; i++){
                document.getElementById("remove-product"+i).style.display = "block";
            }
            button.removeEventListener("click", showRemoveProduct);
            button.addEventListener("click", hideRemoveProduct);
        }

        function hideRemoveProduct(){
            var removeButton = document.getElementsByClassName("remove-product");
            for(var i = 0; i < removeButton.length; i++){
                document.getElementById("remove-product"+i).style.display = "none";
            }
            button.removeEventListener("click", hideRemoveProduct);
            button.addEventListener("click", showRemoveProduct);
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
        //Create Table
        if(isset($_GET["sort"])){
            $sortColumn = $_GET["sort"];
            $sql .= " ORDER BY $sortColumn";
        }
        $result = $conn->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if($result->num_rows > 0){
            echo "
                <table>
                    <tr>
                        <th></th>
                        <th><a href='?sort=product_ID'>Product ID</a></th>
                        <th><a href='?sort=product_name'>Product Name</a></th>
                        <th><a href='?sort=product_description'>Product Description</a></th>
                        <th><a href='?sort=product_price'>Product Price</a></th>
                        <th><a href='?sort=product_status'>Product Status</a></th>
                    </tr>";
            for($x = 0; $x < sizeof($row); $x++){
                echo "<tr>
                        <td><button class='remove-product' id='remove-product$x'>Remove</button></td>
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