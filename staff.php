<?php
require_once 'utils.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Mama Flor's Lechon House</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
    echo "Date: " . date("Y-m-d");
    echo "Branch Assigned: Tipolos";
    echo "<br>";
    ?>
    <pre>
            <a href="gsr.php">Generate Sales Report</a>
            <a href="schedule.php">Schedule</a>
            <a href="editprofile.php">Account Settings</a>
            <a href="?logout">LOG OUT</a>
        </pre>
</body>

</html>