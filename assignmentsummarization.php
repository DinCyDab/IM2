<?php
    ob_start();
    session_start();
    if ($_SESSION["role"] != "Administrator") {
        header("Location: indexstaff.php");
    }
    if (!isset($_SESSION["session_started"])) {
        $_SESSION["session_started"] = TRUE;
        $_SESSION["showEdit"] = FALSE;
        $_SESSION["showRemove"] = FALSE;
    }

    $conn = mysqli_connect("localhost","root","","mamaflors");
    if(!$conn->connect_error){
        $sql = "SELECT
                    staff_ID,
                    CONCAT(first_name, ' ', last_name) AS 'staff_name'
                FROM
                    staff
                ORDER BY
                    staff_ID
        ";
        $result = $conn->query($sql);
        $rowstaff = $result->fetch_all(MYSQLI_ASSOC);
    }
    $conn->close();
    if(isset($_GET["filterdate"])){
        $_SESSION["date"] = $_GET["filterdate"];
    }
    else{
        $_SESSION["date"] = date("Y-m");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="scrollbarstyles.css">
        <link rel="stylesheet" href="styles.css">
        <style>
            body{
                display: block;
                height: auto;
            }
            table{
                display: flex;
                position: relative;
                align-items: center;
                justify-content: center;
                margin-top: 120px;
                width: fit-content;
                top: 0px;
            }
            table th{
                background-color: sandybrown;
                color: brown;
            }
            table a{
                color: brown;
            }
            table tr{
                background-color: brown;
                color: wheat;
                text-align: center;
            }
            table td{
                border: 1px brown solid;
                min-width: fit-content;
                border-radius: 5px;
            }
            table tr:nth-child(even){
                background-color: wheat;
                color: brown;
            }
            .pageheader{
                position: relative;
                /* border: 1px black solid; */
                top: 85px;
                left: 50%;
                transform: translate(-50%, 0);
                z-index: -1;
            }
            .pageheader h1{
                color: wheat;
                text-align: center;
            }
            .functionalitybuttons{
                /* border: 1px black solid; */
                top: 140px;
                display: flex;
                /* width: fit-content; */
                justify-content: center;
                align-items: center;
                padding: 10px;
                position: fixed;
                left: 50%;
                transform: translate(-50%, 0);
                z-index: 1;
            }
            .functionalitybuttons input{
                padding: 10px;
                margin-left: 10px;
                margin-right: 10px;
                border-radius: 10px;
            }
            .tableholder{
                position: relative;
            }
            .legendholder{
                position: relative;
                display: flex;
                /* border: 1px white solid; */
                justify-content: center;
                align-content: center;
                color: wheat;
                top: 115px;
            }
            .legend{
                position: relative;
                padding: 2px;
                height:20px;
                width:20px;
                border-radius:5px;
                top: 50%;
                transform: translate(0%, -50%);
                border: 1px black solid;
            }
            .present{
                background-color: limegreen;
            }
            .absent{
                background-color: tomato;
            }
            .late{
                background-color: orange;
            }
            .off{
                background-color: aqua;
            }
            .nodata{
                background-color: wheat;
            }
            .legends{
                display:flex;
                margin-right:10px;
                margin-left: 10px;
            }
        </style>
    </head>
    <body>
        <div class="functionalitybuttons">
            <form method="get" style="display:flex">
                <input type="month" name="filterdate" value="<?php echo $_SESSION["date"] ?>" />
                <input type="submit" value="Filter Date">
            </form>
        </div>
        <div class="pageheader">
            <h1>Attendance Summarization</h1>
        </div>
        <?php 
            include "navadmin.php";
        ?>
        <div class="legendholder">
            <h6>Legend: </h6>
            <div class="legends">
                <div class="legend present"></div>
                <h6> - Present</h6>
            </div>
            <div class="legends">
                <div class="legend absent"></div>
                <h6> - Absent</h6>
            </div>
            <div class="legends">
                <div class="legend late"></div>
                <h6> - Late</h6>
            </div>
            <div class="legends">
                <div class="legend off"></div>
                <h6> - Off</h6>
            </div>
            <div class="legends">
                <div class="legend nodata"></div>
                <h6> - No Data</h6>
            </div>
        </div>
        <div class="tableholder">
            <table>
                <tr>
                    <th>No.</th>
                    <th>Staff ID</th>
                    <th style="min-width:200px">Name</th>
                    <?php
                        for($x = 1; $x <= date('t', strtotime($_SESSION["date"])); $x++){
                            echo "<th style='padding:0px'>$x</th>";
                        }   
                    ?>
                </tr>
                    <?php
                        $month = date("m", strtotime($_SESSION["date"]));
                        for($x = 0; $x < sizeof($rowstaff); $x++){
                            echo "<tr>
                                    <td>".($x+1)."</td>
                                    <td>".$rowstaff[$x]["staff_ID"]."</td>
                                    <td>".$rowstaff[$x]["staff_name"]."</td>    
                                ";

                            $conn = mysqli_connect("localhost","root","","mamaflors");
                            if(!$conn->connect_error){
                                $sql = "SELECT
                                            assignment.assignment_date,
                                            assignment.assignment_status,
                                            assignment.time_in,
                                            assignment.note,
                                            branch.branch_name
                                        FROM
                                            assignment
                                            INNER JOIN staff ON assignment.staff_ID = staff.staff_ID
                                            LEFT JOIN branch ON assignment.branch_ID = branch.branch_ID
                                        WHERE
                                            assignment.staff_ID = '".$rowstaff[$x]["staff_ID"]."'
                                            AND assignment.assignment_date BETWEEN '2024-$month-01' AND '2024-$month-31'
                                        ORDER BY
                                            assignment.assignment_date";
                                $result = $conn->query($sql);
                                $row = $result->fetch_all(MYSQLI_ASSOC);
                                for($y = 1; $y <= date('t', strtotime($_SESSION['date'])); $y++){
                                    $found = false;
                                    for($z = 0; $z < sizeof($row); $z++){
                                        if($y == date('d', strtotime($row[$z]["assignment_date"]))){
                                            if($row[$z]["assignment_status"] == "Present"){
                                                echo "<td style='background-color: limegreen'
                                                    title='Branch: ".$row[$z]["branch_name"]."\nTime In: ".$row[$z]["time_in"]."\nNote: ".$row[$z]["note"]."'>
                                                    </td>";
                                            }
                                            else if($row[$z]["assignment_status"] == "Absent"){
                                                echo "<td style='background-color: tomato'
                                                    title='Branch: ".$row[$z]["branch_name"]."\nTime In: ".$row[$z]["time_in"]."\nNote: ".$row[$z]["note"]."'>
                                                    </td>";
                                            }
                                            else if($row[$z]["assignment_status"] == "Late"){
                                                echo "<td style='background-color: orange'
                                                    title='Branch: ".$row[$z]["branch_name"]."\nTime In: ".$row[$z]["time_in"]."\nNote: ".$row[$z]["note"]."'>
                                                    </td>";
                                            }
                                            else if($row[$z]["assignment_status"] == "Off"){
                                                echo "<td style='background-color: aqua'
                                                    title='Branch: ".$row[$z]["branch_name"]."\nTime In: ".$row[$z]["time_in"]."\nNote: ".$row[$z]["note"]."'>
                                                    </td>";
                                            }
                                            else{
                                                echo "<td style='background-color: wheat'></td>";
                                            }
                                            $found = true;
                                        }
                                    }
                                    if(!$found){
                                        echo "<td style='background-color: wheat'></td>";
                                    }
                                }
                                echo "</tr>";
                            }
                            $conn->close();
                        }
                    ?>
            </table>
        </div>
    </body>
</html>