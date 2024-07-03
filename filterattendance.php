<table id="table">
    <?php
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        if(isset($_GET["filterAttendance"])){
            $year = $_GET["year"];
            $month = $_GET["month"];
            $day = $_GET["day"];
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
                        assignment_date = DATE('$year/$month/$day')
                        ";
                    
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row) > 0){
                echo "<tr>
                    <th></th>
                    <th></th>
                    <th>No.</th>
                    <th>Staff ID</th>
                    <th>Staff Name</th>
                    <th>Branch ID</th>
                    <th>Branch Name</th>
                    <th>Time in</th>
                    <th>Time out</th>
                    <th>Note</th>
                    <th>Status</th>
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