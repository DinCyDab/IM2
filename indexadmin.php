<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>  
        <pre>
            <?php
                echo "Branch Assigned:";
                echo $_SESSION['branch_assigned'];
                echo "<br>";
            ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="product.php">Product</a>
            <a href="staff.php">Staff</a>
            <a href="branch.php">Branch</a>
            <a href="account.php">Account</a>
            <a href="salesreport.php">Create Sales Report</a>
            <a href="assignment.php">Assignment</a>

            
            <a href="indexstaff.php">INDEX STAFF</a>
        </pre>
    </body>
</html>