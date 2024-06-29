<?php
    $conn = mysqli_connect("localhost","root","","mamaflors");
    if ($conn->connect_error){
        die("ERROR". $conn->connect_error);
    }
    else{
        $sql = "SELECT * FROM product
                WHERE product_status = 'Active'";
        $result = $conn->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if(sizeof($row) > 0){
            echo "
                <div>
                    <button>CLOSE</button>
                    <form method='get'>
                        <select name='addToReport0'>";
                            for($x = 0; $x < sizeof($row); $x++){
                                echo "<option value='".$row[$x]['product_ID']."'>".$row[$x]['product_ID'] . " " . $row[$x]['product_name']."</option>";
                            }
            echo "      </select>
                        <select name='addToReport1'>";
                            for($x = 0; $x < sizeof($row); $x++){
                                echo "<option value='".$row[$x]['product_ID']."'>".$row[$x]['product_ID'] . " " . $row[$x]['product_name']."</option>";
                            }
            echo "      </select>
                        <input type='submit' value='Add To Report' name='addToReport'>
                    </form>
                </div>
            ";
        }
        else{
            echo "No Product Listing";
        }
    }
    $conn->close();
?>

<?php
    if(isset($_GET["addToReport"])){
        $productID = $_GET["addToReport0"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "SELECT * FROM product
                    WHERE product_ID = $productID";
            $result = $conn->query($sql);
            $rowProduct = $result->fetch_all(MYSQLI_ASSOC);

            if(sizeof($rowProduct) > 0){
                // Automatically Get The Account ID on Session
                echo "<div>
                        <form method='post'>
                            ".$rowProduct[0]['product_name']."
                            <br>
                            <input type='hidden' name='productID' value='".$rowProduct[0]['product_ID']."'>
                            Cooked Quantity <input type='number' name='cookedqty'>
                            Reheat Quantity <input type='number' name='reheatqty'>
                            Total Display Quantity <input type='number' name='totaldisplayqty'>
                            Leftover Quantity <input type='number' name='leftoverqty'>
                            Total Sold Quantity <input type='number' name='totalsoldqty'>
                            <input type='submit' value='Submit' name='submitReport'>
                        </form>
                    </div>
                ";
            }
            else{
                echo "Invalid Input Please Add a Branch or Product";
            }
        }
        $conn->close();

        $productID = $_GET["addToReport1"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "SELECT * FROM product
                    WHERE product_ID = $productID";
            $result = $conn->query($sql);
            $rowProduct = $result->fetch_all(MYSQLI_ASSOC);

            if(sizeof($rowProduct) > 0){
                // Automatically Get The Account ID on Session
                echo "<div>
                        <form method='post'>
                            ".$rowProduct[0]['product_name']."
                            <br>
                            <input type='hidden' name='productID' value='".$rowProduct[0]['product_ID']."'>
                            Cooked Quantity <input type='number' name='cookedqty'>
                            Reheat Quantity <input type='number' name='reheatqty'>
                            Total Display Quantity <input type='number' name='totaldisplayqty'>
                            Leftover Quantity <input type='number' name='leftoverqty'>
                            Total Sold Quantity <input type='number' name='totalsoldqty'>
                            <input type='submit' value='Submit' name='submitReport'>
                        </form>
                    </div>
                ";
            }
            else{
                echo "Invalid Input Please Add a Branch or Product";
            }
        }
        $conn->close();
    }
?>

<?php
    if(isset($_POST["submitReport"])){
        $productID = $_POST["productID"];
        $cookedqty = $_POST["cookedqty"];
        $reheatqty = $_POST["reheatqty"];
        $totaldisplayqty = $_POST["totaldisplayqty"];
        $leftoverqty = $_POST["leftoverqty"];
        $totalsoldqty = $_POST["totalsoldqty"];

        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "INSERT INTO salesreport(
                account_ID,
                branch_ID,
                product_ID,
                cooked_qty,
                reheat_qty,
                total_display_qty,
                left_over_qty,
                total_sold_qty
            )
            VALUES(
                '0001',
                '1',
                '$productID',
                '$cookedqty',
                '$reheatqty',
                '$totaldisplayqty',
                '$leftoverqty',
                '$totalsoldqty'
            )";
            $conn->query($sql);
        }
        $conn->close();
    }
?>