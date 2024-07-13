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
                <div id='addSalesReport' class='addSalesReportHolder'>
                    <div class='addSalesReport'>
                        <form class='midAddSalesReport' method='get' id='addToReport'>
                            <input type='hidden' id='sizeHolder' value='0' name='sizeHolder'>
                            <button class='addProductRowButton' type='button' onclick='addProductRow()'>Add Product Listing</button>

                            <button type='button' class='closeButton' onclick='closeAddSalesReport()'>Close</button>
                            <input class='addToReportButton' type='submit' value='Add To Report' name='addToReport'>
                        </form>
                    </div>
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
        var div = document.createElement("div");
        var row = [];
        var rowName = [];

        div.className = "productSelect";

        select.className = 'addToReportProduct';
        select.name = "addToReport" + val;

        remove.type = "button";
        remove.onclick = function() {
            div.removeChild(select);
            div.removeChild(remove);
            div.style.padding = "0px";
        };

        remove.innerText = "Remove";
        div.appendChild(remove);

        <?php
            for($x = 0; $x < sizeof($row); $x++){
                echo "var option = document.createElement('option');\n";
                echo "row[$x] =" . $row[$x]['product_ID'] . ";\n";
                echo "rowName[$x] ='" . $row[$x]['product_name'] . "';\n";
                echo "option.value = row[$x];\n";
                echo "option.innerHTML = rowName[$x];\n";
                echo "select.appendChild(option);\n";
            }
            echo "div.appendChild(select);\n";
        ?>

        addToReport.appendChild(div);

        val++;
        sizeHolder.value = val;
    }
</script>

<?php
    if(isset($_GET["addToReport"])){
        echo "<div class='formDailySalesReport'>
                <form method='post' id='addToReportForm'>
        ";
        for($y = 0; $y < $_GET["sizeHolder"]; $y++){
            if(isset($_GET["addToReport$y"])){
                if($_GET["addToReport$y"] != "Removed"){
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
                            echo "<div id='addToReport$y'>";
                            echo "
                                        <div class='headersubdiv'>
                                            <button type='button' onclick=".'removeProduct("addToReport'.$y.'","productID'.$y.'")'.">Remove</button>
                                            <h2>".$rowProduct[0]['product_name']."</h2>
                                        </div>
                                        <input id='productID$y' type='hidden' name='productID$y' value='".$rowProduct[0]['product_ID']."'>
                                        <div class='subdiv'>
                                            <p>Cooked Quantity:</p>         <input type='number' name='cookedqty$y'>
                                        </div>
                                        <div class='subdiv'>
                                            <p>Reheat Quantity:</p>         <input type='number' name='reheatqty$y'>
                                        </div>
                                        <div class='subdiv'>
                                            <p>Total Display Quantity:</p>  <input type='number' name='totaldisplayqty$y'>
                                        </div>
                                        <div class='subdiv'>
                                            <p>Leftover Quantity:</p>       <input type='number' name='leftoverqty$y'>
                                        </div>
                                        <div class='subdiv'>
                                            <p>Pull-out Quantity:</p>       <input type='number' name='pulloutqty$y'>
                                        </div>
                                        <div class='subdiv'>
                                            <p>Total Sold Quantity:</p>     <input type='number' name='totalsoldqty$y'>
                                        </div>
                                        <div class='subdiv'>
                                            <p>Remittance:</p>              <input type='number' name='remittance$y' required>
                                        </div>
                            ";
                            echo "</div>";
                        }
                        else{
                            echo "Invalid Input Please Add a Branch or Product";
                        }
                    }
                    $conn->close();
                }
                else{
                    unset($_GET["addToReport$y"]);
                    $query_string = http_build_query($_GET);
                    
                    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?') . '?' . $query_string);
                    exit;
                }
            }
        }
        echo "
                    <input id='submitReport' type='submit' value='Submit Report' name='submitReport'>
                </form>
            </div>";
    }
?>

<script>
    var submitReport =document.getElementById("submitReport");
    var addToReportForm =document.getElementById("addToReportForm");

    if(addToReportForm){
        if(addToReportForm.length == 1){
            addToReportForm.removeChild(submitReport);
        }
    }
    function removeProduct(removeRow, productRow){
        var removeProduct = document.getElementById(productRow);
        removeProduct.value = "Removed";

        var currentUrl = window.location.href;
        var url = new URL(currentUrl);
        url.searchParams.set(removeRow, 'Removed');
        window.history.pushState(null, '', url.toString());

        var addToReport = document.getElementById(removeRow);
        addToReport.style.display = "none";
        location.reload();
    }
</script>

<?php
    if(isset($_POST["submitReport"])){
        if(!isset($_SESSION["branch_ID"])){
            include "errormsg.php";
        }
        else{
            $conn = mysqli_connect("localhost","root","","mamaflors");
            if(!$conn->connect_error){
                for($x = 0; $x < $_GET["sizeHolder"]; $x++){
                    if($_POST["productID$x"] != "Removed" && isset($_POST["productID$x"])){
                        $pulloutqty = $_POST["pulloutqty$x"];
                        $remittance = $_POST["remittance$x"];
                        $productID = $_POST["productID$x"];
                        $cookedqty = $_POST["cookedqty$x"];
                        $reheatqty = $_POST["reheatqty$x"];
                        $totaldisplayqty = $_POST["totaldisplayqty$x"];
                        $leftoverqty = $_POST["leftoverqty$x"];
                        $totalsoldqty = $_POST["totalsoldqty$x"];
                        $sql = "INSERT INTO salesreport(
                            account_ID,
                            branch_ID,
                            product_ID,
                            cooked_qty,
                            reheat_qty,
                            total_display_qty,
                            left_over_qty,
                            pull_out_qty,
                            total_sold_qty,
                            remittance
                        )
                        VALUES(
                            '".$_SESSION["account_ID"]."',
                            '".$_SESSION["branch_ID"]."',
                            '$productID',
                            '$cookedqty',
                            '$reheatqty',
                            '$totaldisplayqty',
                            '$leftoverqty',
                            '$pulloutqty',
                            '$totalsoldqty',
                            '$remittance'
                        )";
                        $conn->query($sql);
                    }
                }
            }
            $conn->close();
            header("Location: salesreport.php");
            exit();
        }
    }
?>