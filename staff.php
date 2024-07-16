<?php
require_once 'utils.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Mama Flor's Lechon House</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="images/logo.png" alt="Mamaflors Logo">
        </div>
        <ul class="sidebar-list">
            <li>
                <a href="#">
                    <span>Sales Report</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span>Schedule</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span>Account Settings</span>
                </a>
            </li>
        </ul>
        <div class="account-info">
            <span><?php echo $_SESSION["last_name"] . " (" . $_SESSION["role"] . ")" ?></span>
            <a href="?logout">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                </svg>
            </a>
        </div>
    </div>
    <div class="main">

    </div>
    <script src="script.js"></script>
</body>

</html>