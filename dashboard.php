<?php
    require_once 'utils.php';
    session_start();
    if($_SESSION["role"] == "Regular") {
        header("Location: indexstaff.php");
        exit();
    }
    //Make Date Default
    if (!isset($_GET["filterDate"])) {
        $_SESSION["currDate"] = date("Y-m-d");
    } else {
        $_SESSION["currDate"] = $_GET["currDate"];
    }
    //Make Filter Date Default
    if (!isset($_GET["filterDate"])) {
        $_SESSION["filterDateBy"] = 0;
    } else {
        $_SESSION["filterDateBy"] = $_GET["filterDateBy"];
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <a href="indexadmin.php">Home</a>
        <form method="get">
            Filter By:
            <select name="filterDateBy">
                <option value="0" <?php if ($_SESSION["filterDateBy"] == 0)
                    echo "selected"; ?>>Day</option>
                <option value="7" <?php if ($_SESSION["filterDateBy"] == 7)
                    echo "selected"; ?>>Week</option>
                <option value="30" <?php if ($_SESSION["filterDateBy"] == 30)
                    echo "selected"; ?>>Month</option>
                <option value="365" <?php if ($_SESSION["filterDateBy"] == 365)
                    echo "selected"; ?>>Year</option>
            </select>
            Select Date: <input type="date" value="<?php echo $_SESSION["currDate"] ?>" name="currDate">
            <input type="submit" value="Filter Date" name="filterDate">
        </form>

        <br>

        <?php
        $dataPerBranch = [];

        if (isset($_GET["filterDateBy"])) {
            $_SESSION["filterDateBy"] = $_GET["filterDateBy"];
            $_SESSION["currDate"] = $_GET["currDate"];
        }
        $conn = mysqli_connect("localhost", "root", "", "mamaflors");
        if (!$conn->connect_error) {
            $noDataToShow = false;
            $sql = "SELECT
                            branch_ID, branch_name
                        FROM
                            branch
                ";
            $result = $conn->query($sql);
            $branchList = $result->fetch_all(MYSQLI_ASSOC);

            $date = $_SESSION["currDate"];
            $year = date("Y", strtotime($date));
            $month = date("m", strtotime($date));
            $day = date("d", strtotime($date));

            foreach ($branchList as $branch) {
                $branchID = $branch["branch_ID"];
                $branchName = $branch["branch_name"];
                $sql = "SELECT
                            SUM(salesreport.total_sold_qty) AS total_sold_qty,
                            SUM(salesreport.cooked_qty) AS cooked_qty,
                            SUM(salesreport.reheat_qty) AS reheat_qty,
                            SUM(salesreport.left_over_qty) AS left_over_qty,
                            SUM(salesreport.estimated_revenue) AS estimated_revenue,
                            product.product_name
                        FROM
                            salesreport
                            INNER JOIN product ON salesreport.product_ID = product.product_ID
                            INNER JOIN branch ON salesreport.branch_ID = branch.branch_ID
                        WHERE
                            salesreport.report_date BETWEEN DATE_SUB('".$_SESSION["currDate"]."', INTERVAL ".$_SESSION["filterDateBy"]." DAY) AND '".$_SESSION["currDate"]."'
                            AND salesreport.status = 'Confirmed'
                            AND salesreport.branch_ID = '$branchID' 
                        GROUP BY
                            product.product_ID
                            ";

                            

                $result = $conn->query($sql);
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                $totalSold = [];
                $totalCooked = [];
                $totalReheat = [];
                $totalLeftOver = [];
                $estimatedPartialRevenue = [];

                foreach ($rows as $row) {
                    $totalSold[] = array("label" => $row["product_name"], "y" => (int) $row["total_sold_qty"]);
                    $totalCooked[] = array("label" => $row["product_name"], "y" => (int) $row["cooked_qty"]);
                    $totalReheat[] = array("label" => $row["product_name"], "y" => (int) $row["reheat_qty"]);
                    $totalLeftOver[] = array("label" => $row["product_name"], "y" => (int) $row["left_over_qty"]);
                    $estimatedPartialRevenue[] = array("label" => $row["product_name"], "y" => (int) $row["estimated_revenue"]);
                }
                if (!empty($totalSold) || !empty($totalCooked) || !empty($totalReheat) || !empty($estimatedPartialRevenue) || !empty($totalLeftOver)) {
                    $dataPerBranch[$branchName] = [
                        "totalSold" => $totalSold,
                        "totalCooked" => $totalCooked,
                        "totalReheat" => $totalReheat,
                        "totalLeftOver" => $totalLeftOver,
                        "estimatedPartialRevenue" => $estimatedPartialRevenue
                    ];
                }
            }

            // for ($x = 0; $x < sizeof($branchList); $x++) {
            //     $sql = "SELECT
            //                     branch.branch_name,
			// 					product.product_ID,
            //                     product.product_name,
            //                     SUM(cooked_qty) AS 'cooked_qty',
            //                     SUM(reheat_qty) AS 'reheat_qty',
            //                     SUM(total_display_qty) AS 'total_display_qty',
            //                     SUM(left_over_qty) AS 'left_over_qty',
            //                     SUM(total_sold_qty) AS 'total_sold_qty',
            //                     salesreport.total_sold_qty * product.product_price AS 'estimated_revenue'
            //                 FROM
            //                     salesreport
            //                     INNER JOIN branch ON salesreport.branch_ID = branch.branch_ID
            //                     INNER JOIN product ON salesreport.product_ID = product.product_ID
            //                 WHERE
            //                     salesreport.report_date BETWEEN DATE_SUB('".$_SESSION["currDate"]."', INTERVAL ".$_SESSION["filterDateBy"]." DAY) AND '".$_SESSION["currDate"]."'
            //                     AND
            //                     salesreport.branch_ID = '".$branchList[$x]["branch_ID"]."'
            //                 GROUP BY
            //                 	product.product_ID
            //                     ";
            //     $result = $conn->query($sql);
            //     $row = $result->fetch_all(MYSQLI_ASSOC);
            //     if (sizeof($row) > 0) {
            //         $noDataToShow = false;
            //     } else {
            //         $noDataToShow = true;
            //     }
            //     echo "<br>";
            // }
            // $sql = "SELECT
            //                 salesreport.*,
            //                 salesreport.product_ID,
            //                 product.product_name,
            //                 SUM(total_sold_qty) AS 'Total_Sold',
            //                 SUM(total_sold_qty) * product.product_price AS 'Estimated_Partial_Revenue'
            //             FROM
            //                 salesreport
            //                 INNER JOIN product ON salesreport.product_ID = product.product_ID
            //             WHERE
            //                 salesreport.report_date BETWEEN DATE_SUB('".$_SESSION["currDate"]."', INTERVAL ".$_SESSION["filterDateBy"]." DAY) AND '".$_SESSION["currDate"]."'
            //             GROUP BY
            //                 salesreport.product_ID
            //             ";
            // $result = $conn->query($sql);
            // $row = $result->fetch_all(MYSQLI_ASSOC);
            // if (sizeof($row) > 0) {
            //     $noDataToShow = false;
            // } else {
            //     $noDataToShow = true;
            // }
            $sql = "SELECT
                            SUM(total_sold_qty * product.product_price) AS 'Estimated_Total_Revenue'
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
            if ($row[0]["Estimated_Total_Revenue"] != NULL) {
                $noDataToShow = false;
            } else {
                $noDataToShow = true;
            }
        }
        $conn->close();
        if ($noDataToShow == true) {
            echo "No Data To Show";
        }
        ?>

        <div id="chartContainer" style="height: 370px; width: 100%; display: flex;"></div>

        <script>
            window.onload = function () {

                let dataPerBranch = <?php echo json_encode($dataPerBranch, JSON_NUMERIC_CHECK) ?>;
                let chartsContainer = document.getElementById("chartContainer");

                for (var branch in dataPerBranch) {
                    let branchContainer = document.createElement("div");
                    branchContainer.id = branch.replace(/\s+/g, '') + "Container";
                    branchContainer.style.marginBottom = "50px";
                    // branchContainer.style.flexGrow = "1";
                    branchContainer.style.width = "50%";
                    chartsContainer.appendChild(branchContainer);

                    let chartTypes = ["estimatedPartialRevenue", "totalSold", "totalLeftOver", "totalCooked", "totalReheat"];
                    let titles = ["Estimated Partial Revenue", "Total Sold", "totalLeftOver", "Total Cooked", "Total Reheat"];

                    for (let i = 0; i < chartTypes.length; i++) {
                        let chartContainer = document.createElement("div");
                        chartContainer.id = branch.replace(/\s+/g, '') + chartTypes[i];
                        chartContainer.style.height = "300px";
                        chartContainer.style.width = "50%";
                        branchContainer.appendChild(chartContainer);

                        let chart = new CanvasJS.Chart(chartContainer.id, {
                            animationEnabled: true,
                            theme: "light2",
                            title: {
                                text: `${branch} - ${titles[i]}`
                            },
                            axisY: {
                                title: titles[i]
                            },
                            data: [{
                                type: "column",
                                indexLabel: "{y}",
                                yValueFormatString: "#,##0.##",
                                dataPoints: dataPerBranch[branch][chartTypes[i]]
                            }]
                        });
                        chart.render();
                    }

                }
            }
        </script>
    </body>
    <?php 
            include "navadmin.php";
        ?>
</html>