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
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="staff.php">Staff</a></li>
            <li><a href="branch.php">Branch</a></li>
            <li><a href="account.php">Account</a></li>
            <li><a href="salesreport.php">Sales Report</a></li>
            <li><a href="assignment.php">Assignment</a></li>
            <li><a href="?logout">Log out</a></li>
        </ul>
    </nav>
    <script src="script.js"></script>
</body>

</html>