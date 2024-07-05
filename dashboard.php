<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <a href="indexadmin.php">Home</a>
        <!-- Form for Date starts here -->
        <form method="get">
            <select name="year">
                <option value="2024">2024</option>
            </select>
            <select name="month">
                <?php
                    if(isset($_GET["month"])){
                        $default = $_GET["month"];
                    }
                    else{
                        $default = date("n");
                    }
                    for($x = 1; $x <= 12; $x++){
                        if($x == $default){
                            $selected = 'selected';
                        }
                        else{
                            $selected = '';
                        }
                        echo "<option value='$x' $selected>".date('F', mktime(0, 0, 0, $x))."</option>";
                    }
                ?>
            </select>
            <select name="day">
                <?php
                    if(isset($_GET["day"])){
                        $default_day = $_GET["day"];
                    }
                    else{
                        $default_day = date("d");
                    }

                    for($x = 1; $x <= 31; $x++){
                        if ($x == $default_day) {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }
                        echo "<option value='$x' $selected>$x</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Filter" name="filterAttendance">
        </form>
        <!-- Form for Date ends here -->

        <br>
        <?php
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            if(isset($_GET["filterAttendance"])){
                $year = $_GET["year"];
                $month = $_GET["month"];
                $day = $_GET["day"];
            }
            $conn = mysqli_connect("localhost","root","","mamaflors");
            if(!$conn->connect_error){
                $noDataToShow = false;
                $sql = "SELECT
                            branch_ID
                        FROM
                            branch
                ";
                $result = $conn->query($sql);
                $branchList = $result->fetch_all(MYSQLI_ASSOC);
                for($x = 0; $x < sizeof($branchList); $x++){
                    $sql = "SELECT
                                salesreport.*,
                                branch.*,
                                product.*,
                                salesreport.total_sold_qty * product.product_price AS 'estimated_revenue'
                            FROM
                                salesreport
                                INNER JOIN branch ON salesreport.branch_ID = branch.branch_ID
                                INNER JOIN product ON salesreport.product_ID = product.product_ID
                            WHERE
                                salesreport.report_date = DATE('$year/$month/$day')
                                AND
                                salesreport.branch_ID = '".$branchList[$x]["branch_ID"]."'
                                ";
                    $result = $conn->query($sql);
                    $row = $result->fetch_all(MYSQLI_ASSOC);
                    if(sizeof($row) > 0){
                        echo "Branch: ".$row[0]["branch_name"]." <br>";
                        for($y = 0; $y < sizeof($row); $y++){
                            echo "
                                Product: ".$row[$y]["product_name"]."<br>
                                Cooked Quantity: ".$row[$y]["cooked_qty"]."
                                Reheat Quantity: ".$row[$y]["reheat_qty"]."
                                Total Display Quantity: ".$row[$y]["total_display_qty"]."
                                Left Over Quantity: ".$row[$y]["left_over_qty"]."
                                Total Sold: ".$row[$y]["total_sold_qty"]."
                                Estimated Revenue: ".$row[$y]["estimated_revenue"]."
                                <br>
                            ";
                        }
                    }
                    else{
                        $noDataToShow = true;
                    }
                    echo "<br>";
                }
                $sql = "SELECT
                            salesreport.*,
                            salesreport.product_ID,
                            product.product_name,
                            SUM(total_sold_qty) AS 'Total_Sold',
                            SUM(total_sold_qty) * product.product_price AS 'Estimated_Partial_Revenue'
                        FROM
                            salesreport
                            INNER JOIN product ON salesreport.product_ID = product.product_ID
                        WHERE
                            salesreport.report_date = DATE('$year/$month/$day')
                        GROUP BY
                            salesreport.product_ID
                        ";
                $result = $conn->query($sql);
                $row = $result->fetch_all(MYSQLI_ASSOC);
                if(sizeof($row) > 0){
                    echo "Overview<br>";
                    for($x = 0; $x < sizeof($row); $x++){
                        echo "
                            Total sold ".$row[$x]["product_name"].": ".$row[$x]["Total_Sold"]."<br>
                            Estimated Partial Revenue ".$row[$x]["Estimated_Partial_Revenue"]."<br><br>
                        ";
                    }
                }
                else{
                    $noDataToShow = true;
                }
                $sql = "SELECT
                            SUM(total_sold_qty * product.product_price) AS 'Estimated_Total_Revenue'
                        FROM
                            salesreport
                            INNER JOIN product ON salesreport.product_ID = product.product_ID
                        WHERE
                            salesreport.report_date = DATE('$year/$month/$day')
                            ";
                $result = $conn->query($sql);
                $row = $result->fetch_all(MYSQLI_ASSOC);
                if($row[0]["Estimated_Total_Revenue"] != NULL){
                    echo "Estimated Overall Sales Revenue: ".$row[0]["Estimated_Total_Revenue"];
                }
                else{
                    $noDataToShow = true;
                }
            }
            $conn->close();
            if($noDataToShow == true){
                echo "No Data To Show";
            }
        ?>
    </body>
</html>