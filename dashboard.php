<?php
    session_start();
    if($_SESSION["role"] != "Administrator"){
        header("Location: indexstaff.php");
    }
    //Make Date Default
    if(!isset($_GET["filterDate"])){
        $_SESSION["currDate"] = date("Y-m-d");
    }
    else{
        $_SESSION["currDate"] = $_GET["currDate"];
    }
    //Make Filter Date Default
    if(!isset($_GET["filterDate"])){
        $_SESSION["filterDateBy"] = 0;
    }
    else{
        $_SESSION["filterDateBy"] = $_GET["filterDateBy"];
    }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <a href="indexadmin.php">Home</a>

        <form method="get">
            Filter By:
            <select name="filterDateBy">
                <option value="0" <?php if($_SESSION["filterDateBy"] == 0 )echo "selected";?>>Day</option>
                <option value="7" <?php if($_SESSION["filterDateBy"] == 7 )echo "selected";?>>Week</option>
                <option value="30" <?php if($_SESSION["filterDateBy"] == 30 )echo "selected";?>>Month</option>
                <option value="365" <?php if($_SESSION["filterDateBy"] == 365 )echo "selected";?>>Year</option>
            </select>
            Select Date: <input type="date" value="<?php echo $_SESSION["currDate"]?>" name="currDate">
            <input type="submit" value="Filter Date" name="filterDate">
        </form>

        <br>

        <?php
            if(isset($_GET["filterDateBy"])){
                $_SESSION["filterDateBy"] = $_GET["filterDateBy"];
                $_SESSION["currDate"] = $_GET["currDate"];
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
                                branch.branch_name,
								product.product_ID,
                                product.product_name,
                                SUM(cooked_qty) AS 'cooked_qty',
                                SUM(reheat_qty) AS 'reheat_qty',
                                SUM(total_display_qty) AS 'total_display_qty',
                                SUM(left_over_qty) AS 'left_over_qty',
                                SUM(total_sold_qty) AS 'total_sold_qty',
                                SUM(salesreport.estimated_revenue) AS 'estimated_revenue'
                            FROM
                                salesreport
                                INNER JOIN branch ON salesreport.branch_ID = branch.branch_ID
                                INNER JOIN product ON salesreport.product_ID = product.product_ID
                            WHERE
                                salesreport.report_date BETWEEN DATE_SUB('".$_SESSION["currDate"]."', INTERVAL ".$_SESSION["filterDateBy"]." DAY) AND '".$_SESSION["currDate"]."'
                                AND
                                salesreport.branch_ID = '".$branchList[$x]["branch_ID"]."'
                                AND
                                salesreport.status = 'Confirmed'
                            GROUP BY
                            	product.product_ID
                                ";
                    $result = $conn->query($sql);
                    $row = $result->fetch_all(MYSQLI_ASSOC);
                    if(sizeof($row) > 0){
                        $noDataToShow = false;
                        echo "Branch: ".$row[0]["branch_name"]." <br>";
                        for($y = 0; $y < sizeof($row); $y++){
                            echo "
                                Product: ".$row[$y]["product_name"]."<br>
                                Cooked Quantity: ".$row[$y]["cooked_qty"]."
                                Reheat Quantity: ".$row[$y]["reheat_qty"]."
                                Total Display Quantity: ".$row[$y]["total_display_qty"]."
                                Left Over Quantity: ".$row[$y]["left_over_qty"]."
                                Total Sold: ".$row[$y]["total_sold_qty"]."
                                Revenue: ".$row[$y]["estimated_revenue"]."
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
                            SUM(salesreport.estimated_revenue) AS 'Confirmed_Partial_Revenue'
                        FROM
                            salesreport
                            INNER JOIN product ON salesreport.product_ID = product.product_ID
                        WHERE
                            salesreport.report_date BETWEEN DATE_SUB('".$_SESSION["currDate"]."', INTERVAL ".$_SESSION["filterDateBy"]." DAY) AND '".$_SESSION["currDate"]."'
                            AND
                            salesreport.status = 'Confirmed'
                        GROUP BY
                            salesreport.product_ID
                        ";
                $result = $conn->query($sql);
                $row = $result->fetch_all(MYSQLI_ASSOC);
                if(sizeof($row) > 0){
                    $noDataToShow = false;
                    echo "Overview<br>";
                    for($x = 0; $x < sizeof($row); $x++){
                        echo "
                            Total sold ".$row[$x]["product_name"].": ".$row[$x]["Total_Sold"]."<br>
                            Partial Revenue: ".$row[$x]["Confirmed_Partial_Revenue"]."<br><br>
                        ";
                    }
                }
                else{
                    $noDataToShow = true;
                }
                $sql = "SELECT
                            SUM(salesreport.estimated_revenue) AS 'Confirmed_Total_Revenue'
                        FROM
                            salesreport
                            INNER JOIN product ON salesreport.product_ID = product.product_ID
                        WHERE
                            salesreport.report_date BETWEEN DATE_SUB('".$_SESSION["currDate"]."', INTERVAL ".$_SESSION["filterDateBy"]." DAY) AND '".$_SESSION["currDate"]."'
                            AND
                            salesreport.status = 'Confirmed'
                            ";
                $result = $conn->query($sql);
                $row = $result->fetch_all(MYSQLI_ASSOC);
                if($row[0]["Confirmed_Total_Revenue"] != NULL){
                    $noDataToShow = false;
                    echo "Overall Sales Revenue: ".$row[0]["Confirmed_Total_Revenue"];
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