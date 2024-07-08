<?php
    if(isset($_GET["edit"])){
        $valueToEdit = $_GET["edit"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if(!$conn->connect_error){
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
            if(sizeof($row) > 0){
                echo "
                    <div>
                        <form method='post'>
                            Cooked Quantity <input type='text' name='cooked_qty' value='".$row[0]["cooked_qty"]."'>
                            Reheat Quantity <input type='text' name='reheat_qty' value='".$row[0]["reheat_qty"]."'>
                            Total Display Quantity <input type='text' name='total_display_qty' value='".$row[0]["total_display_qty"]."'>
                            Left Over Quantity <input type='text' name='left_over_qty' value='".$row[0]["left_over_qty"]."'>
                            Total Sold Quantity <input type='text' name='total_sold_qty' value='".$row[0]["total_sold_qty"]."'>
                            Revenue: <input type='text' name='confirmed_revenue' value='".$row[0]["revenue"]."' readonly>
                            Status:
                            <select name='status'>
                                <option value='Pending'>Pending</option>
                                <option value='Confirmed'>Confirmed</option>
                            </select>
                            <input type='submit' value='Update' name='Update'>
                        </form>
                    </div>
                ";
            }
        }
        $conn->close();
    }
?>

<?php 
    if(isset($_POST["Update"])){
        $confirmedrevenue = NULL;
        $cooked_qty = $_POST["cooked_qty"];
        $reheat_qty = $_POST["reheat_qty"];
        $total_display_qty = $_POST["total_display_qty"];
        $left_over_qty = $_POST["left_over_qty"];
        $total_sold_qty = $_POST["total_sold_qty"];
        $status = $_POST["status"];
        if($status == "Confirmed"){
            $confirmedrevenue = $_POST["confirmed_revenue"];
        }

        $conn = mysqli_connect("localhost","root","","mamaflors");
        if(!$conn->connect_error){
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
                    confirmed_revenue = '$confirmedrevenue'
                WHERE
                    report_ID = $valueToEdit
            ";
            $conn->query($sql);
        }
        $conn->close();
        header("Location: salesreport.php");
        exit();
    }
?>