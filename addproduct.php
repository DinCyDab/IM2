<?php
if($_SESSION["role"] == "Regular") {
    header("Location: indexstaff.php");
    exit();
}
?>
<div class="addproductholder" id="add">
    <div class="add-product">
        <div style="display:flex">
            <h4>Add Product</h4>
            <button onclick="hideAdd()">Close</button>
        </div>
        <div>
            <form method="POST">
                <div style="display:flex">
                    <h4>Product Name:</h4>
                    <input type="text" name="product-name" required>
                </div>
                <div style="display:flex">
                    <h4>Product Description:</h4>
                    <input type="text" name="product-description">
                </div>
                <div style="display:flex">
                    <h4>Product Price:</h4>
                    <input type="number" name="product-price" min="0" max="9999999999">
                </div>
                <div style="display:flex">
                    <h4>Product Status:</h4>
                    <select name="product-status">
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
                <input type="submit" value="Submit" name="Submit">
            </form>
        </div>
    </div>
</div>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Submit"])){
        $productName = $_POST["product-name"];
        $productDesc = $_POST["product-description"];
        $productPrice = $_POST["product-price"];
        $productStatus = $_POST["product-status"];

        $conn = mysqli_connect("localhost","root","","mamaflors");

        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "INSERT INTO product(product_name, product_description, product_price, product_status)
                    VALUES('$productName', '$productDesc', $productPrice, '$productStatus')";
            $conn->query($sql);

        }
        $conn->close();
        header("Location: product.php");
        exit();
    }
?>