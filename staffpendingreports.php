<?php
    ob_start();
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            table{
                border-collapse: collapse;
            }
            th, tr{
                border: 1px aqua solid;
            }
            tr:nth-child(even){
                background-color: aqua;
            }
        </style>
    </head>
    <body>

    <a href="indexstaff.php">Back</a>

    <?php 
        include "staffeditreport.php";
        include "remove.php"
    ?>
    <?php
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if(!$conn->connect_error){
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
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row)> 0){
                echo "
                    <table>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Report ID</th>
                            <th>Product Name</th>
                            <th>Report Date</th>
                            <th>Cooked</th>
                            <th>Reheat</th>
                            <th>Total Display</th>
                            <th>Leftover</th>
                            <th>Pull Out</th>
                            <th>Total Sold</th>
                            <th>Remittance</th>
                            <th>Status</th>
                        </tr>
                ";
                for($x = 0; $x < sizeof($row); $x++){
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
            }
            else{
                echo "Hooray! No Pending Reports";
            }
        }
        $conn->close();
    ?>
    </body>
    <script src="filtertable.js"></script>
</html>