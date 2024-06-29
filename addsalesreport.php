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
                        <select name='addToReport'>";
                            for($x = 0; $x < sizeof($row); $x++){
                                echo "<option value='".$row[$x]['product_ID']."'>".$row[$x]['product_ID'] . " " . $row[$x]['product_name']."</option>";
                            }
            echo "      </select>
                        <input type='submit' value='Add To Report'>
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
        $productID = $_GET["addToReport"];
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
                            Cooked Quantity <input type='number' name='cookedqty'>
                            Reheat Quantity <input type='number' name='reheatqty'>
                            Total Display Quantity <input type='number' name='totaldisplayqty'>
                            Leftover Quantity <input type='number' name='leftoverqty'>
                            Total Sold Quantity <input type='number' name='totalsoldqty'>
                            <input type='submit' value='Submit'>
                        </form>
                    </div>
                ";
            }
            else{
                echo "Invalid Please Add a Branch or Product";
            }
        }
        $conn->close();
    }
?>

<?php
    
?>