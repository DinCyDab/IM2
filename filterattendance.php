<?php
if($_SESSION["role"] != "Administrator"){
    header("Location: indexstaff.php");
    exit();
}
?>
<table id="table">
    <?php   
        $date = date("Y-m-d");
        if(isset($_GET["filterAttendance"])){
            $date = $_GET["date"];
        }
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if(!$conn->connect_error){
            $sql = "SELECT
                        assignment.*,
                        CONCAT(staff.last_name, ', ', staff.first_name, ' ', staff.middle_name) AS 'staff_name',
                        branch.branch_name
                    FROM
                        (assignment
                        LEFT JOIN branch ON assignment.branch_ID = branch.branch_ID)
                        INNER JOIN staff ON assignment.staff_ID = staff.staff_ID
                    WHERE
                        assignment_date = DATE('$date')
                        ";
            if(isset($_GET["sort"])){
                if($_SESSION["SORT"] == "DESC"){
                    $_SESSION["SORT"] = "ASC";
                }
                else{
                    $_SESSION["SORT"] = "DESC";
                }
                $sql .= " ORDER BY " . $_GET["sort"] . " " . $_SESSION["SORT"];
            }
                    
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row) > 0){
                echo "<tr>
                    <th></th>
                    <th></th>
                    <th>No.</th>
                    <th><a href='?sort=staff_ID'>Staff ID</a></th>
                    <th><a href='?sort=staff_name'>Staff Name</a></th>
                    <th><a href='?sort=branch_ID'>Branch ID</a></th>
                    <th><a href='?sort=branch_name'>Branch Name</a></th>
                    <th><a href='?sort=time_in'>Time in</a></th>
                    <th><a href='?sort=time_out'>Time out</a></th>
                    <th><a href='?sort=note'>Note</a></th>
                    <th><a href='?sort=assignment_status'>Status</a></th>
                </tr>";
                for($x = 0; $x < sizeof($row); $x++){
                    echo "<tr>
                        <td>
                            <form method='get'>
                                <input type='hidden' value='".($row[$x]['assignment_ID'])."' name='edit'>
                                <button class='edit-row' id='edit-row$x' type='submit'>EDIT</button>
                            </form>
                        </td>
                        <td>
                            <form method='get'>
                                <input type='hidden' value='".($row[$x]['assignment_ID'])."' name='removeID'>
                                <input type='hidden' value='assignment' name='tableName'>
                                <input type='hidden' value='assignment_ID' name='columnName'>
                                <button class='remove-row' id='remove-row$x' name='remove'>Remove</button>
                            </form>
                        </td>
                        <td>".($x+1)."</td>
                        <td>".$row[$x]['staff_ID']."</td>
                        <td>".$row[$x]['staff_name']."</td>
                        <td>".$row[$x]['branch_ID']."</td>
                        <td>".$row[$x]['branch_name']."</td>
                        <td>".$row[$x]['time_in']."</td>
                        <td>".$row[$x]['time_out']."</td>
                        <td>".$row[$x]['note']."</td>
                        <td>".$row[$x]['assignment_status']."</td>
                    </tr>";
                }
                echo "</table>";
            }
        }
        $conn->close();
    ?>