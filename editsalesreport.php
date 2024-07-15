<?php
if (isset($_GET["edit"])) {
    $valueToEdit = $_GET["edit"];
    $conn = mysqli_connect("localhost", "root", "", "mamaflors");
    if (!$conn->connect_error) {
        $sql = "
                    SELECT
                        *,
                        salesreport.total_sold_qty * product.product_price AS 'revenue'
                    FROM
                        salesreport
                        INNER JOIN product ON salesreport.product_ID = product.product_ID
                    WHERE
                        report_ID = $valueToEdit
            ";
        $result = $conn->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if (sizeof($row) > 0) {
            echo "
                    <div class='editreportholder' id='edit'>
                        <div class='edit-report'>
                            <div style='display:flex'>
                                <h4>Edit Report</h4>
                                <button onclick='hideEdit()'>CLOSE</button>
                            </div>
                            <div>
                                <form method='post' class='edit-report-form'>
                                    <div>
                                        <h4>Report ID:</h4> <input type='text' name='report_ID' value='".$row[0]["report_ID"]."' readonly>
                                        <h4>Report Date:</h4> <input type='text' name='report_date' value='".$row[0]["report_date"]."' readonly>
                                    </div>
                                    <div>
                                        <h4>Account ID:</h4>
                                        <input type='text' name='account_ID' value='".$row[0]["account_ID"]."' readonly>
                                        <h4>Product Name:</h4>
                                        <input type='text' name='product_name' value='".$row[0]["product_name"]."' readonly>
                                    </div>
                                    <div>
                                        <h4>Cooked Quantity:</h4> <input type='text' name='cooked_qty' value='".$row[0]["cooked_qty"]."'>
                                        <h4>Reheat Quantity:</h4> <input type='text' name='reheat_qty' value='".$row[0]["reheat_qty"]."'>
                                    </div>
                                    <div>
                                        <h4>Total Display Quantity</h4> <input type='text' name='total_display_qty' value='".$row[0]["total_display_qty"]."'>
                                        <h4>Left Over Quantity</h4><input type='text' name='left_over_qty' value='".$row[0]["left_over_qty"]."'>
                                    </div>
                                    <div>
                                        <h4>Total Sold Quantity</h4> <input type='text' name='total_sold_qty' value='".$row[0]["total_sold_qty"]."'>
                                    </div>
                                    <div>
                                        <h4>Estimated Revenue:</h4> <input type='text' name='confirmed_revenue' value='".$row[0]["revenue"]."' readonly>
                                        <h4>Remittance:</h4> <input type='text' name='remittance' value='".$row[0]["remittance"]."' readonly>
                                        <h4>Status:</h4>
                                        <select name='status'>
                                            <option value='Pending'>Pending</option>
                                            <option value='Confirmed'>Confirmed</option>
                                        </select>
                                    </div>
                                    <input type='submit' value='Update' name='Update'>
                                </form>
                            </div>
                        </div>
                    </div>
                ";
        }
    }
    $conn->close();
}
?>

<?php
if (isset($_POST["Update"])) {
    $confirmedrevenue = NULL;
    $report_date = $_POST["report_date"];
    $account_ID = $_POST["account_ID"];
    $cooked_qty = $_POST["cooked_qty"];
    $reheat_qty = $_POST["reheat_qty"];
    $total_display_qty = $_POST["total_display_qty"];
    $left_over_qty = $_POST["left_over_qty"];
    $total_sold_qty = $_POST["total_sold_qty"];
    $status = $_POST["status"];
    if ($status == "Confirmed") {
        $confirmedrevenue = $_POST["remittance"];
    }

    $conn = mysqli_connect("localhost", "root", "", "mamaflors");
    if (!$conn->connect_error) {
        $sql = "
                UPDATE
                    salesreport
                SET
                    cooked_qty = '$cooked_qty',
                    reheat_qty = '$reheat_qty',
                    total_display_qty = '$total_display_qty',
                    left_over_qty = '$left_over_qty',
                    total_sold_qty = '$total_sold_qty',
                    status = '$status',
                    estimated_revenue = '$confirmedrevenue'
                WHERE
                    report_ID = $valueToEdit
            ";
        $conn->query($sql);
    }
    $conn->close();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>