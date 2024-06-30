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
        <a href="index.php">Home</a>

        <br>

        <button>ADD</button>

        <br>

        <?php
            include "addsalesreport.php";
        ?>
    </body>
</html>

<?php
    $conn = mysqli_connect("localhost","root","","mamaflors");
    if($conn->connect_error){
        die("ERROR". $conn->connect_error);
    }
    else{
        $sql = "SELECT
                    salesreport.*,
                    branch.branch_name,
                    product.product_name,
                    staff.last_name,
                    staff.first_name,
                    staff.middle_name
                FROM
                    ((salesreport
                INNER JOIN branch on salesreport.branch_ID = branch.branch_ID)
                INNER JOIN product on salesreport.product_ID = product.product_ID)
                INNER JOIN staff on salesreport.account_ID = staff.staff_ID
                    ";
        $result = $conn->query( $sql );
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if(sizeof($row) > 0){
            echo "<table>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Report ID</th>
                    <th>Account ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Branch ID</th>
                    <th>Branch Name</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Report Date</th>
                    <th>Report Time</th>
                    <th>Cooked</th>
                    <th>Reheat</th>
                    <th>Total Display</th>
                    <th>Leftover</th>
                    <th>Total Sold</th>
                </tr>
            ";
                    
            for($x = 0; $x < sizeof($row); $x++){
                echo "<tr>
                    <td>
                        <form method='get'>
                            <input type='hidden' value='".($row[$x]['report_ID'])."' name='edit'>
                            <button class='edit-product-row' id='edit-product-row$x' type='submit'>EDIT</button>
                        </form>
                    </td>
                    <td><form method='get'>
                            <input type='hidden' value='".($row[$x]['report_ID'])."' name='remove'>
                            <button class='remove-product' id='remove-product$x'>Remove</button>
                        </form>
                    </td>
                    <td>".$row[$x]['report_ID']."</td>
                    <td>".$row[$x]['account_ID']."</td>
                    <td>".$row[$x]['last_name']."</td>
                    <td>".$row[$x]['first_name']."</td>
                    <td>".$row[$x]['middle_name']."</td>
                    <td>".$row[$x]['branch_ID']."</td>
                    <td>".$row[$x]['branch_name']."</td>
                    <td>".$row[$x]['product_ID']."</td>
                    <td>".$row[$x]['product_name']."</td>
                    <td>".$row[$x]['report_date']."</td>
                    <td>".$row[$x]['report_time']."</td>
                    <td>".$row[$x]['cooked_qty']."</td>
                    <td>".$row[$x]['reheat_qty']."</td>
                    <td>".$row[$x]['total_display_qty']."</td>
                    <td>".$row[$x]['left_over_qty']."</td>
                    <td>".$row[$x]['total_sold_qty']."</td>
                </tr>";
            }

            echo "</table>";
        }
        else{
            echo "Empty Database";
        }
    }
    $conn->close();
?>