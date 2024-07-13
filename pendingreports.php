<?php
ob_start();
session_start();
if ($_SESSION["role"] != "Administrator") {
    header("Location: indexstaff.php");
}
if (!isset($_SESSION["session_started"])) {
    $_SESSION["session_started"] = TRUE;
    $_SESSION["showEdit"] = FALSE;
    $_SESSION["showRemove"] = FALSE;
}
if (!isset($_SESSION["SORT"])) {
    $_SESSION["SORT"] = "DESC";
}
?>

<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="scrollbarstyles.css">
        <style>
            body {
                display: block;
            }

            .remove-row {
                display:
                <?php
                if (isset($_SESSION["showRemove"])) {
                    if ($_SESSION["showRemove"] == TRUE) {
                        echo "block";
                    } else {
                        echo "none";
                    }
                } else {
                    echo "none";
                }
                ?>
                ;
            }

            .edit-row {
                display:
                <?php
                if (isset($_SESSION["showEdit"])) {
                    if ($_SESSION["showEdit"] == TRUE) {
                        echo "block";
                    } else {
                        echo "none";
                    }
                } else {
                    echo "none";
                }
                ?>
                ;
            }

            .functionalitybuttons {
                /* border: 1px black solid; */
                top: 100px;
                display: flex;
                /* width: fit-content; */
                justify-content: center;
                align-items: center;
                padding: 10px;
                position: fixed;
                left: 50%;
                transform: translate(-50%, 0);
                z-index: 1;
            }

            .functionalitybuttons button {
                padding: 10px;
                margin-left: 10px;
                margin-right: 10px;
                border-radius: 10px;
                background-color: white;
            }

            .functionalitybuttons input {
                padding: 10px;
                margin-left: 10px;
                margin-right: 10px;
                border-radius: 10px;
            }

            table {
                display: flex;
                position: relative;
                align-items: center;
                justify-content: center;
                margin-top: 120px;
                width: fit-content;
                top: 40px;
            }

            table th {
                background-color: sandybrown;
                color: brown;
            }

            table a {
                color: brown;
            }

            table tr {
                background-color: brown;
                color: wheat;
                text-align: center
            }

            table tr:nth-child(even) {
                background-color: wheat;
                color: brown;
            }

            .pageheader {
                position: relative;
                /* border: 1px black solid; */
                top: 140px;
                left: 50%;
                transform: translate(-50%, 0);
                z-index: -1;
            }

            .pageheader h1 {
                color: wheat;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div class="functionalitybuttons">
            <a href="salesreport.php"><button>ALL REPORTS</button></a>
            <form method="post">
                <button id="remover" name="removeButton" value="pendingreports">REMOVE</button>
            </form>
            <form method="post">
                <button id="editor" name="editButton" value="pendingreports">EDIT</button>
            </form>
            <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Sales Report...">
        </div>
        <div class="pageheader">
            <h1>Pending Reports</h1>
        </div>

        <?php
        include "navadmin.php";
        include "editsalesreport.php";
        include "remove.php";
        ?>
    </body>
    <script src="filtertable.js"></script>

</html>

<?php
$conn = mysqli_connect("localhost", "root", "", "mamaflors");
if ($conn->connect_error) {
    die("ERROR".$conn->connect_error);
} else {
    $sql = "SELECT
                    salesreport.*,
                    branch.branch_name,
                    product.product_name,
                    product.product_price,
                    staff.last_name,
                    staff.first_name,
                    staff.middle_name,
                    salesreport.total_sold_qty * product.product_price AS 'revenue'
                FROM
                    ((salesreport
                    INNER JOIN branch on salesreport.branch_ID = branch.branch_ID)
                    INNER JOIN product on salesreport.product_ID = product.product_ID)
                    INNER JOIN staff on salesreport.account_ID = staff.staff_ID
                WHERE
                    salesreport.status = 'Pending'
                ORDER BY
                    salesreport.report_date, salesreport.report_time, salesreport.report_ID
                    ";
    $result = $conn->query($sql);
    $row = $result->fetch_all(MYSQLI_ASSOC);
    if (sizeof($row) > 0) {
        echo "<table id='table'>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Report ID</th>
                    <th>Report Date</th>
                    <th>First Name</th>
                    <th>Branch Name</th>
                    <th>Product Name</th>
                    <th>Cooked</th>
                    <th>Reheat</th>
                    <th>Total Display</th>
                    <th>Leftover</th>
                    <th>Pull Out</th>
                    <th>Total Sold</th>
                    <th>Estimated Revenue</th>
                    <th>Remittance</th>
                    <th>Status</th>
                </tr>
            ";

        for ($x = 0; $x < sizeof($row); $x++) {
            echo "<tr>
                    <td>
                        <form method='get'>
                            <input type='hidden' value='".($row[$x]['report_ID'])."' name='edit'>
                            <button class='edit-row' id='edit-row$x' type='submit'>EDIT</button>
                        </form>
                    </td>
                    <td>
                        <form method='get'>
                            <input type='hidden' value='".($row[$x]['report_ID'])."' name='removeID'>
                            <input type='hidden' value='salesreport' name='tableName'>
                            <input type='hidden' value='report_ID' name='columnName'>
                            <button class='remove-row' id='remove-row$x' name='remove'>Remove</button>
                        </form>
                    </td>
                    <td>".$row[$x]['report_ID']."</td>
                    <td>".$row[$x]['report_date']."</td>
                    <td>".$row[$x]['first_name']."</td>
                    <td>".$row[$x]['branch_name']."</td>
                    <td>".$row[$x]['product_name']."</td>
                    <td>".$row[$x]['cooked_qty']."</td>
                    <td>".$row[$x]['reheat_qty']."</td>
                    <td>".$row[$x]['total_display_qty']."</td>
                    <td>".$row[$x]['left_over_qty']."</td>
                    <td>".$row[$x]['pull_out_qty']."</td>
                    <td>".$row[$x]['total_sold_qty']."</td>
                    <td>".$row[$x]['revenue']."</td>
                    <td>".$row[$x]['remittance']."</td>
                    <td>".$row[$x]['status']."</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No Pending Reports";
    }
}
$conn->close();
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editButton"])) {
    $pageName = $_POST["editButton"];
    if ($_SESSION["showEdit"] == FALSE) {
        $_SESSION["showEdit"] = TRUE;
    } else {
        $_SESSION["showEdit"] = FALSE;
    }
    header("Location:$pageName.php");
    exit();
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["removeButton"])) {
    $pageName = $_POST["removeButton"];
    if ($_SESSION["showRemove"] == FALSE) {
        $_SESSION["showRemove"] = TRUE;
    } else {
        $_SESSION["showRemove"] = FALSE;
    }
    header("Location:$pageName.php");
    exit();
}
?>