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
                    <form method='get' id='addToReport'>
                        <input type='submit' value='Add To Report' name='addToReport'>
                    </form>
                </div>
            ";
            echo"<button onclick='addProductRow()'>+</button>";
        }
        else{
            echo "No Product Listing";
        }
    }
    $conn->close();
?>
<script>
    var val = 0;
    function addProductRow(){
        var select = document.createElement("select");
        var addToReport = document.getElementById("addToReport");
        var row = [];
        var rowName = [];
        select.name = "addToReport" + val;
        <?php
            for($x = 0; $x < sizeof($row); $x++){
                echo "var option = document.createElement('option');\n";
                echo "row[$x] =" . $row[$x]['product_ID'] . ";\n";
                echo "rowName[$x] ='" . $row[$x]['product_name'] . "';\n";
                echo "option.value = row[$x];\n";
                echo "option.innerHTML = rowName[$x];\n";
                echo "select.appendChild(option);\n";
            }
            echo "addToReport.appendChild(select);\n";
        ?>
        val++;
    }
</script>


<?php
    if(isset($_GET["addToReport"])){
        echo "<div>
                <form method='post'>
        ";
        for($y = 0; isset($_GET["addToReport$y"]); $y++){
            $productID = $_GET["addToReport$y"];
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
                    // Automatically Get The Account ID during Session
                    echo $rowProduct[0]['product_name']."
                                <br>
                                <input type='hidden' name='productID$y' value='".$rowProduct[0]['product_ID']."'>
                                Cooked Quantity         <input type='number' name='cookedqty$y'>
                                Reheat Quantity         <input type='number' name='reheatqty$y'>
                                Total Display Quantity  <input type='number' name='totaldisplayqty$y'>
                                Leftover Quantity       <input type='number' name='leftoverqty$y'>
                                Total Sold Quantity     <input type='number' name='totalsoldqty$y'>
                                <br>
                    ";
                }
                else{
                    echo "Invalid Input Please Add a Branch or Product";
                }
            }
            $conn->close();
        }
        echo "
                    <input type='submit' value='Submit' name='submitReport'>
                </form>
            </div>";
    }
?>

<?php
    if(isset($_POST["submitReport"])){
        for($x = 0; isset($_POST["productID$x"]); $x++){
            $productID = $_POST["productID$x"];
            $cookedqty = $_POST["cookedqty$x"];
            $reheatqty = $_POST["reheatqty$x"];
            $totaldisplayqty = $_POST["totaldisplayqty$x"];
            $leftoverqty = $_POST["leftoverqty$x"];
            $totalsoldqty = $_POST["totalsoldqty$x"];

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
            echo "<a href='index.php'>Daily Sales Report Submitted</a>";
        }
    }
?>