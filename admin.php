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
    <nav>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Product</a></li>
            <li><a href="#">Staff</a></li>
            <li><a href="#">Branch</a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">Sales Report</a></li>
            <li><a href="#">Assignment</a></li>
            <li><a href="?logout">Log Out</a></li>
        </ul>
    </nav>
    <script src="script.js"></script>
</body>

</html>