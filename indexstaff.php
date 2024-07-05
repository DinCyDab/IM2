<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            echo $_SESSION["account_ID"];
        ?>
        <pre>
            <a href="gsr.php">Generate Sales Report</a>
            <a href="editprofile.php">Account Settings</a>
            <a href="logout.php">LOG OUT</a>
        </pre>
    </body>
</html>