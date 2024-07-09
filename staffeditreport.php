<?php
    if(isset($_GET["edit"])){
        $valueToEdit = $_GET["edit"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if(!$conn->connect_error){
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
            if(sizeof($row) > 0){
                echo "
                    <div id='edit' class='edit-product'>
                        <button onclick='hideEdit()'>CLOSE</button>
                        <form method='post'>
                            Report ID: <input type='text' name='report_ID' value='".$row[0]["report_ID"]."' readonly>
                            Report Date: <input type='text' name='report_date' value='".$row[0]["report_date"]."' readonly>
                            Product Name: <input type='text' name='product_name' value='".$row[0]["product_name"]."' readonly>
                            Cooked <input type='number' name='cooked_qty' value='".$row[0]["cooked_qty"]."'>
                            Reheat <input type='number' name='reheat_qty' value='".$row[0]["reheat_qty"]."'>
                            Total Display <input type='number' name='total_display_qty' value='".$row[0]["total_display_qty"]."'>
                            Left Over  <input type='number' name='left_over_qty' value='".$row[0]["left_over_qty"]."'>
                            Pull Out  <input type='number' name='pull_out_qty' value='".$row[0]["pull_out_qty"]."'>
                            Total Sold  <input type='number' name='total_sold_qty' value='".$row[0]["total_sold_qty"]."'>
                            Remittance: <input type='number' name='remittance' value='".$row[0]["remittance"]."'>
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
        $cooked_qty = $_POST["cooked_qty"];
        $reheat_qty = $_POST["reheat_qty"];
        $total_display_qty = $_POST["total_display_qty"];
        $left_over_qty = $_POST["left_over_qty"];
        $pull_out_qty = $_POST["pull_out_qty"];
        $total_sold_qty = $_POST["total_sold_qty"];
        $remittance = $_POST["remittance"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if(!$conn->connect_error){
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