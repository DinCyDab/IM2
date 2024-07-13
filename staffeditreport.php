<?php
if (isset($_GET["edit"])) {
    $valueToEdit = $_GET["edit"];
    $conn = mysqli_connect("localhost", "root", "", "mamaflors");
    if (!$conn->connect_error) {
        $sql = "SELECT
                        *
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
                <div id='edit' class='edit-report'>
                    <h3>Edit Sales Report</h3>
                    <form method='post'>
                        <div class='reportInfo'><label for='report_ID'>Report ID</label> <input type='text' name='report_ID' value='".$row[0]["report_ID"]."' readonly></div>
                        <div class='reportInfo'><label for='report_date'>Report Date</label> <input type='text' name='report_date' value='".$row[0]["report_date"]."' readonly></div>
                        <div class='reportInfo'><label for='product_name'>Product Name</label> <input type='text' name='product_name' value='".$row[0]["product_name"]."' readonly></div>
                        <div class='reportInfo'><label for='cooked_qty'>Cooked</label> <input type='number' name='cooked_qty' value='".$row[0]["cooked_qty"]."'></div>
                        <div class='reportInfo'><label for='reheat_qty'>Reheat</label> <input type='number' name='reheat_qty' value='".$row[0]["reheat_qty"]."'></div>
                        <div class='reportInfo'><label for='total_display_qty'>Total Display</label> <input type='number' name='total_display_qty' value='".$row[0]["total_display_qty"]."'></div>
                        <div class='reportInfo'><label for='left_over_qty'>Left Over</label>  <input type='number' name='left_over_qty' value='".$row[0]["left_over_qty"]."'></div>
                        <div class='reportInfo'><label for='pull_out_qty'>Pull Out</label>  <input type='number' name='pull_out_qty' value='".$row[0]["pull_out_qty"]."'></div>
                        <div class='reportInfo'><label for='total_sold_qty'>Total Sold</label>  <input type='number' name='total_sold_qty' value='".$row[0]["total_sold_qty"]."'></div>
                        <div class='reportInfo'><label for='remittance'>Remittance:</label> <input type='number' name='remittance' value='".$row[0]["remittance"]."'></div>
                        <input type='submit' value='Update' name='Update' class='update'>
                        </form>
                        <button onclick='hideEdit()' class='closeBtn'>CLOSE</button>
                </div>
                ";
        }
    }
    $conn->close();
}
?>

<?php
if (isset($_POST["Update"])) {
    $cooked_qty = $_POST["cooked_qty"];
    $reheat_qty = $_POST["reheat_qty"];
    $total_display_qty = $_POST["total_display_qty"];
    $left_over_qty = $_POST["left_over_qty"];
    $pull_out_qty = $_POST["pull_out_qty"];
    $total_sold_qty = $_POST["total_sold_qty"];
    $remittance = $_POST["remittance"];
    $conn = mysqli_connect("localhost", "root", "", "mamaflors");
    if (!$conn->connect_error) {
        $sql = "UPDATE
                        salesreport
                    SET
                        cooked_qty = '$cooked_qty',
                        reheat_qty = '$reheat_qty',
                        total_display_qty = '$total_display_qty',
                        left_over_qty = '$left_over_qty',
                        pull_out_qty = '$pull_out_qty',
                        total_sold_qty = '$total_sold_qty',
                        remittance = '$remittance'
                    WHERE
                        report_ID = $valueToEdit
                ";
        $conn->query($sql);
    }
    $conn->close();
    header("Location: ".$_SERVER["PHP_SELF"]);
    exit();
}
?>