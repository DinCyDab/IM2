<?php
    ob_start();
    session_start();
    if(!isset($_SESSION["session_started"])){
        $_SESSION["session_started"] = TRUE;
        $_SESSION["showEdit"] = FALSE;
        $_SESSION["showRemove"] = FALSE;
    }
    if(!isset($_SESSION["SORT"])){
        $_SESSION["SORT"] = "DESC";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            .remove-row{
                display: <?php
                        if(isset($_SESSION["showRemove"])){
                            if($_SESSION["showRemove"] == TRUE){
                                echo "block";
                            }
                            else{
                                echo "none";
                            }
                        }
                        else{
                            echo "none";
                        }
                    ?>;
            }
            .edit-row{
                display: <?php
                        if(isset($_SESSION["showEdit"])){
                            if($_SESSION["showEdit"] == TRUE){
                                echo "block";
                            }
                            else{
                                echo "none";
                            }
                        }
                        else{
                            echo "none";
                        }
                    ?>;
            }
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

        <button onclick="showAdd()">ADD</button>
        <form method="post">
            <button id="remover" name="removeButton" value="salesreport">REMOVE</button>
        </form>
        <form method="post">
            <button id="editor" name="editButton" value="salesreport">EDIT</button>
        </form>
        <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Sales Report...">

        <br>

        <?php
            include "addsalesreport.php";
            include "remove.php"
        ?>
    </body>
    <?php
        include "filtertable.php";
    ?>
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
            echo "<table id='table'>
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

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editButton"])){
        $pageName = $_POST["editButton"];
        if($_SESSION["showEdit"] == FALSE){
            $_SESSION["showEdit"] = TRUE;
        }
        else{
            $_SESSION["showEdit"] = FALSE;
        }
        header("Location:$pageName.php");
        exit();
    }
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["removeButton"])){
        $pageName = $_POST["removeButton"];
        if($_SESSION["showRemove"] == FALSE){
            $_SESSION["showRemove"] = TRUE;
        }
        else{
            $_SESSION["showRemove"] = FALSE;
        }
        header("Location:$pageName.php");
        exit();
    }
?>