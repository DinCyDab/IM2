<?php
require_once 'utils.php';
session_start();
if ($_SESSION["role"] != "Administrator") {
    header("Location: staff.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Mama Flor's Lechon House</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <nav>
            <ul>
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="#">Product</a></li>
                <li><a href="staff.php">Staff</a></li>
                <li><a href="#">Branch</a></li>
                <li><a href="#">Account</a></li>
                <li><a href="#">Sales Report</a></li>
                <li><a href="#">Assignment</a></li>
                <li><a href="?logout">Log Out</a></li>
            </ul>
        </nav>
        <button class="notif"><img></button>
    </div>
    <div class="main">
        
    </div>
    <script src="script.js"></script>
</body>

</html>