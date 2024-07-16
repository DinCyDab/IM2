<?php
    ob_start();
    session_start();
    if ($_SESSION["role"] == "Regular") {
        header("Location: indexstaff.php");
    }
    if(!isset($_SESSION["session_started"])){
        $_SESSION["session_started"] = TRUE;
        $_SESSION["showEdit"] = FALSE;
        $_SESSION["showRemove"] = FALSE;
    }
    if(!isset($_SESSION["SORT"])){
        $_SESSION["SORT"] = "DESC";
    }

    if(!isset($_SESSION["chosendate"])){
        $_SESSION["chosendate"] = date("Y-m-d");
    }
    else if(isset($_GET["filterdate"])){
        $_SESSION["chosendate"] = $_GET["filterdate"];
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="scrollbarstyles.css">
        <style>
            body{
                display: block
            }
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
            .functionalitybuttons{
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
            .functionalitybuttons button{
                padding: 10px;
                margin-left: 10px;
                margin-right: 10px;
                border-radius: 10px;
                background-color: white;
            }
            .functionalitybuttons input{
                padding: 10px;
                margin-left: 10px;
                margin-right: 10px;
                border-radius: 10px;
            }
            table{
                display: flex;
                position: relative;
                align-items: center;
                justify-content: center;
                margin-top: 120px;
                width: fit-content;
                top: 40px;
            }
            table th{
                background-color: sandybrown;
                color: brown;
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
                top: 140px;
                left: 50%;
                transform: translate(-50%, 0);
                z-index: -1;
            }
            .pageheader h1{
                color: wheat;
                text-align: center;
            }
            .editreportholder{
                display: block;
                width: 100%;
                height: 100vh;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, .5);
                padding: 15px;
                position: fixed;
                z-index: 2;
            }
            .edit-report{
                position: relative;
                background-color: wheat;
                width: fit-content;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                border: none;
                border-radius: 20px;
                box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.50);
            }
            .edit-report div{
                border: 1px black solid;
                padding: 15px;
            }
            .edit-report h4{
                margin: 0;
            }
            .edit-report-form div{
                display: flex;
            }
        </style>
    </head>
    <body>
        <div class="functionalitybuttons">
            <a href="pendingreports.php"><button style="width:max-content">PENDING REPORTS</button></a>
            <form method="post">
                <button id="remover" name="removeButton" value="salesreport">REMOVE</button>
            </form>
            <form method="post">
                <button id="editor" name="editButton" value="salesreport">EDIT</button>
            </form>
            <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Sales Report...">
            <form method="get" style="display:flex">
                <input type="date" name="filterdate" value="<?php echo $_SESSION["chosendate"]?>">
                <input type="submit" value="Filter Date">
            </form>
        </div>
        
        <div class="pageheader">
            <h1>Sales Reports</h1>
        </div>
        <?php
            include "editsalesreport.php";
            include "remove.php";
            include "navadmin.php";
        ?>
    </body>
    <script src="filtertable.js"></script>
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
                    salesreport.report_date = '".$_SESSION["chosendate"]."'
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
        $result = $conn->query( $sql );
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if(sizeof($row) > 0){
            echo "<table id='table'>
                <tr>
                    <th></th>
                    <th></th>
                    <th><a href='?sort=report_ID'>Report ID</a></th>
                    <th><a href='?sort=first_name'>First Name</a></th>
                    <th><a href='?sort=branch_name'>Branch Name</a></th>
                    <th><a href='?sort=product_name'>Product Name</a></th>
                    <th><a href='?sort=cooked_qty'>Cooked</a></th>
                    <th><a href='?sort=reheat_qty'>Reheat</a></th>
                    <th><a href='?sort=total_display_qty'>Total Display</a></th>
                    <th><a href='?sort=left_over_qty'>Leftover</a></th>
                    <th><a href='?sort=pull_out_qty'>Pull Ou</a>t</th>
                    <th><a href='?sort=total_sold_qty'>Total Sold</a></th>
                    <th><a href='?sort=estimated_revenue'>Estimated Revenue</a></th>
                    <th><a href='?sort=remittance'>Remittance</a></th>
                    <th><a href='?sort=estimated_revenue'>Confirmed Revenue</a></th>
                    <th><a href='?sort=status'>Status</a></th>
                </tr>
            ";
                    
            for($x = 0; $x < sizeof($row); $x++){
                echo "<tr>
                    <td>";
                        if($row[$x]["status"] != "Confirmed"){
                            echo"
                                <form method='get'>
                                    <input type='hidden' value='".($row[$x]['report_ID'])."' name='edit'>
                                    <button class='edit-row' id='edit-row$x' type='submit'>EDIT</button>
                                </form>
                            ";
                        }
                echo"</td>
                    <td>";
                        if($row[$x]['status'] != "Confirmed"){
                            echo"
                                <form method='get'>
                                    <input type='hidden' value='".($row[$x]['report_ID'])."' name='removeID'>
                                    <input type='hidden' value='salesreport' name='tableName'>
                                    <input type='hidden' value='report_ID' name='columnName'>
                                    <button class='remove-row' id='remove-row$x' name='remove'>Remove</button>
                                </form>
                            ";
                        }
                echo"</td>
                    <td>".$row[$x]['report_ID']."</td>
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
                    <td>".$row[$x]['estimated_revenue']."</td>
                    <td>".$row[$x]['status']."</td>
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
        $query = "";
        if(isset($_SERVER["QUERY_STRING"])){
            $query = $_SERVER["QUERY_STRING"];
        }
        if($_SESSION["showEdit"] == FALSE){
            $_SESSION["showEdit"] = TRUE;
        }
        else{
            $_SESSION["showEdit"] = FALSE;
        }
        header("Location:$pageName.php?$query");
        exit();
    }
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["removeButton"])){
        $pageName = $_POST["removeButton"];
        $query = "";

        if(isset($_SERVER["QUERY_STRING"]) && strpos($_SERVER["QUERY_STRING"], "filterdate")){
            $query = $_SERVER["QUERY_STRING"];
        }
        if($_SESSION["showRemove"] == FALSE){
            $_SESSION["showRemove"] = TRUE;
        }
        else{
            $_SESSION["showRemove"] = FALSE;
        }
        header("Location:$pageName.php?$query");
        exit();
    }
?>