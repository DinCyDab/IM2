<?php
    session_start();
    if($_SESSION["role"] != "Administrator"){
        header("Location: indexstaff.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>  
        <pre>
            <?php
                echo "Date: " . date("Y-m-d");
                echo " Branch Assigned:";
                echo $_SESSION['branch_assigned'];
                echo "<br>";
            ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="product.php">Product</a>
            <a href="staff.php">Staff</a>
            <a href="branch.php">Branch</a>
            <a href="account.php">Account</a>
            <a href="salesreport.php">Sales Report</a>
            <a href="assignment.php">Assignment</a>

            <a href="logout.php">Log out</a>
        </pre>
    </body>
</html>