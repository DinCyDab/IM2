<button id="showNotifs" onclick="showNotifs()">Notifications:</button>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "mamaflors");
        if(!$conn->connect_error){
            $sql = "SELECT
                        salesreport.report_ID,
                        product.product_name,
                        product.product_price,
                        branch.branch_name,
                        salesreport.cooked_qty,
                        salesreport.reheat_qty,
                        salesreport.total_display_qty,
                        salesreport.left_over_qty,
                        salesreport.total_sold_qty,
                        product.product_price * salesreport.total_sold_qty AS 'revenue',
                        salesreport.status  
                    FROM
                        (salesreport
                        INNER JOIN product ON product.product_ID = salesreport.product_ID)
                        INNER JOIN branch ON salesreport.branch_ID = branch.branch_ID
                    WHERE
                        status = 'Pending'
            ";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            echo sizeof($row);
            if(sizeof($row) > 0){
                echo "<table style='display:none' id='notif'>";
                echo "<tr>
                    <th>Report ID</th>
                    <th>Product Name</th>
                    <th>Branch Name</th>
                    <th>Total Sold Quantity</th>
                    <th>Revenue</th>
                    <th>Status</th>
                </tr>";
                for($x = 0; $x < sizeof($row); $x++){
                    echo "
                        <tr>
                            <td>".$row[$x]["report_ID"]."</td>
                            <td>".$row[$x]["product_name"]."</td>
                            <td>".$row[$x]["branch_name"]."</td>
                            <td>".$row[$x]["total_sold_qty"]."</td>
                            <td>".$row[$x]["revenue"]."</td>
                            <td>".$row[$x]["status"]."</td>
                        </tr>
                    ";
                }
                echo "</table>";
                echo "<a style='display: none' id='linkSales' href='salesreport.php'>Click here to confirm report and see more details.</a>";
            }
            else{
                echo "No Pending Reports";
            }
        }
        $conn->close();    
    ?>
<script>
    function showNotifs(){
        var showNotifsButton = document.getElementById("showNotifs");
        var notif = document.getElementById("notif");
        var link = document.getElementById("linkSales");
        notif.style.display = "block";
        link.style.display = "block";
        showNotifsButton.removeEventListener("click", showNotifs);
        showNotifsButton.addEventListener("click", hideNotifs);
    }
    function hideNotifs(){
        var showNotifsButton = document.getElementById("showNotifs");
        var notif = document.getElementById("notif");
        var link = document.getElementById("linkSales");
        notif.style.display = "none";
        link.style.display = "none";
        showNotifsButton.removeEventListener("click", hideNotifs);
        showNotifsButton.addEventListener("click", showNotifs);
    }
</script>