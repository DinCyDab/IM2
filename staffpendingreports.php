<?php
ob_start();
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("Location: index.php");
    exit();
}
if(!isset($_SESSION["SORT"])){
    $_SESSION["SORT"] = "DESC";
}
?>

<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="staffeditreport.css">
        <style>
            body{
                display: block;
            }
            table{
                display: flex;
                position: relative;
                align-items: center;
                justify-content: center;
                margin-top: 120px;
                width: fit-content;
                top: 0px;
                left:50%;
                transform: translate(-50%, 0);
            }
            table th{
                background-color: sandybrown;
            }
            table a{
                color: brown;
            }
            table tr{
                background-color: brown;
                color: wheat;
                text-align: center
            }
            table tr:nth-child(even){
                background-color: wheat;
                color: brown;
            }
            .pageheader{
                position: relative;
                /* border: 1px black solid; */
                top: 90px;
                left: 50%;
                transform: translate(-50%, 0);
                z-index: -1;
            }
            .pageheader h1{
                color: wheat;
                text-align: center;
                font-family: cursive;
            }
        </style>
    </head>

    <body>
        <div class="pageheader">
            <h1>Pending Reports</h1>
        </div>
        <?php
        include "staffeditreport.php";
        include "remove.php";
        include "navstaff.php";
        ?>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "mamaflors");
        if (!$conn->connect_error) {
            $sql = "SELECT
                        salesreport.*,
                        branch.*,
                        product.*
                    FROM
                        (salesreport
                        INNER JOIN branch ON salesreport.branch_ID = branch.branch_ID)
                        INNER JOIN product ON salesreport.product_ID = product.product_ID
                    WHERE
                        account_ID = '".$_SESSION["account_ID"]."'
                        AND
                        status = 'Pending'
            ";
            if(isset($_GET["sort"])){
                if($_SESSION["SORT"] == "DESC"){
                    $_SESSION["SORT"] = "ASC";
                }
                else{
                    $_SESSION["SORT"] = "DESC";
                }
                $sql .= " ORDER BY " . $_GET["sort"] . " " . $_SESSION["SORT"];
            }
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if (sizeof($row) > 0) {
                echo "
                    <table>
                        <tr>
                            <th></th>
                            <th></th>
                            <th><a href='?sort=report_ID'>Report ID</a></th>
                            <th><a href='?sort=product_name'>Product Name</a></th>
                            <th><a href='?sort=report_date'>Report Date</a></th>
                            <th><a href='?sort=cooked_qty'>Cooked</a></th>
                            <th><a href='?sort=reheat_qty'>Reheat</a></th>
                            <th><a href='?sort=total_display_qty'>Total Display</a></th>
                            <th><a href='?sort=left_over_qty'>Leftover</a></th>
                            <th><a href='?sort=pull_out_qty'>Pull Out</a></th>
                            <th><a href='?sort=total_sold_qty'>Total Sold</a></th>
                            <th><a href='?sort=remittance'>Remittance</a></th>
                            <th><a href='?sort=status'>Status</a></th>
                        </tr>
                ";
                for ($x = 0; $x < sizeof($row); $x++) {
                    echo "
                        <tr>
                            <td>
                                <form method='get'>
                                    <input type='hidden' value='".($row[$x]['report_ID'])."' name='edit'>
                                    <button class='edit-row' id='edit-row$x' type='submit'>EDIT</button>
                                </form>
                            </td>
                            <td>
                                <form method='get'>
                                    <input type='hidden' value='staffpendingreports' name='staffpendingreports'>
                                    <input type='hidden' value='".($row[$x]['report_ID'])."' name='removeID'>
                                    <input type='hidden' value='salesreport' name='tableName'>
                                    <input type='hidden' value='report_ID' name='columnName'>
                                    <button class='remove-row' id='remove-row$x' name='remove'>Remove</button>
                                </form>
                            </td>
                            <td>".$row[$x]["report_ID"]."</td>
                            <td>".$row[$x]["product_name"]."</td>
                            <td>".$row[$x]["report_date"]."</td>
                            <td>".$row[$x]["cooked_qty"]."</td>
                            <td>".$row[$x]["reheat_qty"]."</td>
                            <td>".$row[$x]["total_display_qty"]."</td>
                            <td>".$row[$x]["left_over_qty"]."</td>
                            <td>".$row[$x]["pull_out_qty"]."</td>
                            <td>".$row[$x]["total_sold_qty"]."</td>
                            <td>".$row[$x]["remittance"]."</td>
                            <td>".$row[$x]["status"]."</td>
                        </tr>
                    ";
                }
                echo "</table>";
            } else {
                echo "Hooray! No Pending Reports";
            }
        }
        $conn->close();
        ?>
    </body>
    <script src="filtertable.js"></script>

</html>