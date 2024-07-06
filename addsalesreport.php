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
                <div id='addSalesReport' class='addSalesReport'>
                    <button onclick='closeAddSalesReport()'>CLOSE</button>
                    <form method='get' id='addToReport'>
                        <input type='hidden' id='sizeHolder' value='0' name='sizeHolder'>
                        <input type='submit' value='Add To Report' name='addToReport'>
                    </form>
                    <button onclick='addProductRow()'>+</button>
                </div>
            ";
        }
        else{
            echo "No Product Listing";
        }
    }
    $conn->close();
?>

<script>
    var val = 0;
    var sizeHolder = document.getElementById("sizeHolder");
    function addProductRow(){
        var select = document.createElement("select");
        var remove = document.createElement("button");
        var addToReport = document.getElementById("addToReport");
        var addSalesReport = document.getElementById("addSalesReport");
        var row = [];
        var rowName = [];
        select.name = "addToReport" + val;

        remove.onclick = function() {
            addToReport.removeChild(select);
            addSalesReport.removeChild(remove);
        };

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

        remove.innerText = "Remove";
        addSalesReport.appendChild(remove);

        val++;
        sizeHolder.value = val;
    }
</script>

<?php
    if(isset($_GET["addToReport"])){
        echo "<div>
                <form method='post'>
        ";
        for($y = 0; $y < $_GET["sizeHolder"]; $y++){
            if(isset($_GET["addToReport$y"])){
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
                    '".$_SESSION["account_ID"]."',
                    '".$_SESSION["branch_ID"]."',
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
        header("Location: salesreport.php");
    }
?>