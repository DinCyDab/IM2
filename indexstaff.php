<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            echo "Date: " . date("Y-m-d");
            echo " Branch Assigned:";
            echo $_SESSION['branch_assigned'];
            echo "<br>";
        ?>
        <pre>
            <a href="gsr.php">Generate Sales Report</a>
            <a href="editprofile.php">Account Settings</a>
            <a href="logout.php">LOG OUT</a>
        </pre>
    </body>
</html>