<?php
    if(!isset($_SESSION["session_started"])){
        session_start();
        $_SESSION["session_started"] = TRUE;
    }
    if(!isset($_SESSION["SORT"])){
        $_SESSION["SORT"] = "DESC";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            .add-account{
                display: none;
            }
            .remove-row{
                display: none;
            }
            .edit-product{
                display: block;
            }
            .edit-row{
                display: none;
            }
            /* table design */
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
        <button id="remover">REMOVE</button>
        <button id="editor">EDIT</button>
        <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Account...">

        <br>
        <?php
            include "addaccount.php";
            include "remove.php";
            include "editaccount.php";
        ?>
    </body>
    <script src="filtertable.js"></script>
</html>

<?php
    //Retrieve account sql
    $conn = mysqli_connect("localhost","root","","mamaflors");
    if($conn->connect_error){
        die("ERROR". $conn->connect_error);
    }
    else{
        $sql = "SELECT
                    account.*,
                    staff.last_name,
                    staff.first_name,
                    staff.middle_name
                FROM
                    account
                    INNER JOIN staff ON account.account_ID = staff.staff_ID
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
        if(sizeof($row) > 0){
            echo "<table id='table'>
                <tr>
                    <th></th>
                    <th></th>
                    <th><a href='?sort=account_ID'>Account ID</a></th>
                    <th><a href='?sort=last_name'>Last Name</a></th>
                    <th><a href='?sort=first_name'>First Name</a></th>
                    <th><a href='?sort=middle_name'>Middle Name</a></th>
                    <th><a href='?sort=created_date'>Created Date</a></th>
                    <th><a href='?sort=created_time'>Created Time</a></th>
                    <th><a href='?sort=password'>Password</a></th>
                    <th><a href='?sort=role'>Role</a></th>
                    <th><a href='?sort=account_status'>Account Status</a></th>
                </tr>
            ";
            for($x = 0; $x < sizeof($row); $x++){
                echo "
                    <tr>
                        <td>
                            <form method='get'>
                                <input type='hidden' value='".($row[$x]['account_ID'])."' name='edit'>
                                <button class='edit-row' id='edit-row$x' type='submit'>EDIT</button>
                            </form>
                        </td>
                        <td>
                            <form method='get' action='remove.php'>
                                <input type='hidden' value='".($row[$x]['account_ID'])."' name='removeID'>
                                <input type='hidden' value='account' name='tableName'>
                                <input type='hidden' value='account_ID' name='columnName'>
                                <button class='remove-row' id='remove-row$x' name='remove'>Remove</button>
                            </form>
                        </td>
                        <td>".$row[$x]["account_ID"]."</td>
                        <td>".$row[$x]["last_name"]."</td>
                        <td>".$row[$x]["first_name"]."</td>
                        <td>".$row[$x]["middle_name"]."</td>
                        <td>".$row[$x]["created_date"]."</td>
                        <td>".$row[$x]["created_time"]."</td>
                        <td>".$row[$x]["password"]."</td>
                        <td>".$row[$x]["role"]."</td>
                        <td>".$row[$x]["account_status"]."</td>
                    </tr>
                ";
            }
            echo "</table>";
        }
        else{
            echo "EMPTY DATABASE";
        }
    }
    $conn->close();
?>