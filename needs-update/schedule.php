<?php
    ob_start();
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            table{
                border-collapse: collapse;
            }
            th, tr{
                border: 1px aqua solid;
            }
            tr:nth-child(even){
                background-color: aqua;
            }
        </style>
    </head>
    <body>
        <a href="indexstaff.php">Back</a>
        <br>
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
                if(sizeof($row) > 0){
                    $today = new DateTime();
                    $today->modify("Monday this week");
                    echo "<br>";
                    echo "<table>";
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
                    for($x = 0; $x < sizeof($row);){
                        if($row[$x]["assignment_date"] == $today->format("Y-m-d")){
                            echo "<td>".$row[$x]["branch_name"]."</td>";
                            $x++;
                        }
                        else{
                            echo "<td></td>";
                        }
                        $today->modify("+1 day");
                    }
                    echo "</tr>";
                    echo "</table>";
                }
                else{
                    echo "Please Contact Administrator To Get Your This Week Schedule <br>";
                }
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
                if(sizeof($row) > 0){
                    $today = new DateTime();
                    $today->modify("Monday next week");
                    echo "<br>";
                    echo "<table>";
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
                    for($x = 0; $x < sizeof($row);){
                        if($row[$x]["assignment_date"] == $today->format("Y-m-d")){
                            echo "<td>".$row[$x]["branch_name"]."</td>";
                            $x++;
                        }
                        else{
                            echo "<td></td>";
                        }
                        $today->modify("+1 day");
                    }
                    echo "</tr>";
                    echo "</table>";
                }
                else{
                    echo "Please Contact Administrator To Get Your Next Week Schedule";
                }
            }
            $conn->close();
        ?>
    </body>
</html>