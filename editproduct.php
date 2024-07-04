<?php
    if(isset($_GET["edit"])){
        $productid = $_GET["edit"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "SELECT * FROM product
                    WHERE product_ID = $productid";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row)>0){
                echo'
                    <div id="edit" class="edit-product">
                        <button onclick="hideEdit()">Close</button>
                        <form method="post">
                            Product Name:           <input type="text" name="productname" value="'.$row[0]["product_name"].'" required>
                            Product Description:    <input type="text" name="productdescription" value="'.$row[0]["product_description"].'">
                            Product Price:          <input type="number" name="productprice" value="'.$row[0]["product_price"].'">
                            Product Status:
                            <select name="productstatus" value="'.$row[0]["product_status"].'">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <input type="submit" value="Update" name="Update">
                        </form>
                    </div>
                ';
            }
            else{
                echo "No Product Listed";
            }
        }
        $conn->close();
    }
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Update"])){
        $productname = $_POST["productname"];
        $productdescription = $_POST["productdescription"];
        $productprice = $_POST["productprice"];
        $productstatus = $_POST["productstatus"];

        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "UPDATE product
                    SET
                        product_name = '$productname',
                        product_description = '$productdescription',
                        product_price = '$productprice',
                        product_status = '$productstatus'
                    WHERE product_ID = $productid
                    ";
            $conn->query($sql);
        }
        $conn->close();
        $_SESSION["showEdit"] = TRUE;
        header("Location: product.php");
        exit();
    }
?>