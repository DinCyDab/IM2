<?php
    ob_start();
    session_start();
    if(!isset($_SESSION["loggedin"])){
        header ("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <style>
            body{
                display: block;
                height: auto;
            }
            .scheduleTableThisWeek{
                width: 90%;
                position: relative;
                top: 35px;
                left: 50%;
                transform: translate(-50%, 0);
            }
            .scheduleHeader{
                position: relative;
                /* border: 1px white solid; */
                top: 75px;
            }
            .scheduleHeader h1{
                text-align: center;
                color: whitesmoke;
                font-family: cursive;
            }
            .scheduleTableThisWeek th{
                background-color: sandybrown;
                font-size: 25px;
            }
            .scheduleTableThisWeek td{
                background-color: wheat;
                text-align: center;
                color: black;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <?php 
            include "navstaff.php";
        ?>
        <div class="scheduleHeader">
            <h1>Schedule</h1>
        </div>
        <?php 
            $conn = mysqli_connect("localhost","root","","mamaflors");
            if(!$conn->connect_error){
                $sql = "SELECT
							assignment.assignment_date,
                            branch.branch_name
                        FROM
                            (assignment
                            INNER JOIN account ON assignment.staff_ID = account.account_ID)
                            INNER JOIN branch ON assignment.branch_ID = branch.branch_ID
                        WHERE
                            WEEK(assignment.assignment_date, 1) = (WEEK(CURRENT_DATE, 1))
                            AND
                            account.account_ID = '".$_SESSION["account_ID"]."'
                        ORDER BY
                        	assignment_date
                ";
                $result = $conn->query($sql);
                $row = $result->fetch_all(MYSQLI_ASSOC);
                // if(sizeof($row) > 0){
                    $today = new DateTime();
                    $today->modify("Monday this week");
                    echo "<br>";
                    echo "<table class='scheduleTableThisWeek'>";
                    echo "<tr>";
                        for($x = 0; $x < 7; $x++){
                            echo "
                                <th>".$today->format('l, F j')."</th>
                            ";
                            $today->modify('+1 day');
                        }
                    echo "</tr>";

                    $today->modify("-7 day");
                    
                    echo "<tr>";
                    for($x = 0; $x < 7; $x++){
                        $found = false;
                        for($y = 0; $y < sizeof($row); $y++){
                            if($row[$y]["assignment_date"] == $today->format("Y-m-d")){
                                echo "<td>".$row[$y]["branch_name"]."</td>";
                                $found = true;
                                break;
                            }
                        }
                        if(!$found){
                            echo "<td style='background-color: indianred'>OFF</td>";
                        }
                        $today->modify("+1 day");
                    }
                    echo "</tr>";
                    echo "</table>";
                // }
            }
            $conn->close();
        ?>

        <?php 
            $conn = mysqli_connect("localhost","root","","mamaflors");
            if(!$conn->connect_error){
                $sql = "SELECT
							assignment.assignment_date,
                            branch.branch_name
                        FROM
                            (assignment
                            INNER JOIN account ON assignment.staff_ID = account.account_ID)
                            INNER JOIN branch ON assignment.branch_ID = branch.branch_ID
                        WHERE
                            WEEK(assignment.assignment_date, 1) = (WEEK(CURRENT_DATE, 1) + 1)
                            AND
                            account.account_ID = '".$_SESSION["account_ID"]."'
                        ORDER BY
                        	assignment_date
                ";
                $result = $conn->query($sql);
                $row = $result->fetch_all(MYSQLI_ASSOC);
                // if(sizeof($row) > 0){
                    $today = new DateTime();
                    $today->modify("Monday next week");
                    echo "<br>";
                    echo "<table class='scheduleTableThisWeek'>";
                    echo "<tr>";
                        for($x = 0; $x < 7; $x++){
                            echo "
                                <th>".$today->format('l, F j')."</th>
                            ";
                            $today->modify('+1 day');
                        }
                    echo "</tr>";

                    $today->modify("-7 day");
                    
                    echo "<tr>";
                    for($x = 0; $x < 7; $x++){
                        $found = false;
                        for($y = 0; $y < sizeof($row); $y++){
                            if($row[$y]["assignment_date"] == $today->format("Y-m-d")){
                                echo "<td>".$row[$y]["branch_name"]."</td>";
                                $found = true;
                                break;
                            }
                        }
                        if(!$found){
                            echo "<td style='background-color: indianred'>OFF</td>";
                        }
                        $today->modify("+1 day");
                    }
                    echo "</tr>";
                    echo "</table>";
                // }
            }
            $conn->close();
        ?>
    </body>
</html>