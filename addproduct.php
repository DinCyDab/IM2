<?php
if($_SESSION["role"] != "Administrator"){
    header("Location: indexstaff.php");
    exit();
}
?>
<div class="add-product" id="add">
    <button onclick="hideAdd()">Close</button>
    <form method="POST">
        Product Name        <input type="text" name="product-name" required>
        Product Description <input type="text" name="product-description">
        Product Price       <input type="number" name="product-price" min="0" max="9999999999">
        Product Status
        <select name="product-status">
            <option>Active</option>
            <option>Inactive</option>
        </select>
        <input type="submit" value="Submit" name="Submit">
    </form>
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