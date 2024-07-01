<div>
    <form method="post">
        Branch Assigned: 
        <select name="branchid">
            <?php
                $conn = mysqli_connect("localhost","root","","mamaflors");
                if($conn->connect_error){
                    die("ERROR". $conn->connect_error);
                }
                else{
                    $sql = "SELECT * FROM branch";
                    $result = $conn->query($sql);
                    $row = $result->fetch_all(MYSQLI_ASSOC);
                    if(sizeof($row) > 0){
                        for($x = 0; $x < sizeof($row); $x++){
                            echo "<option value='".$row[$x]['branch_ID']."'>".$row[$x]['branch_name']."</option>";
                        }
                    }
                }
                $conn->close();
            ?>
        </select>
        Staff Assigned: 
        <select name="staffid">
            <?php
                $conn = mysqli_connect("localhost","root","","mamaflors");
                if($conn->connect_error){
                    die("ERROR". $conn->connect_error);
                }
                else{
                    $sql = "SELECT * FROM staff";
                    $result = $conn->query($sql);
                    $row = $result->fetch_all(MYSQLI_ASSOC);
                    if(sizeof($row) > 0){
                        for($x = 0; $x < sizeof($row); $x++){
                            echo "<option value='".$row[$x]['staff_ID']."'>".$row[$x]['last_name']." ". $row[$x]['first_name'] . "</option>";
                        }
                    }
                }
                $conn->close();
            ?>
        </select>
        Assignment Date: <input type="date" name="assignmentdate">
        Time In: <input type="time" name="timein">
        Time Out: <input type="time" name="timeout">
        Note: <input type="text" name="note">
        Status:
        <select name="status">
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
        <input type="submit" value="Submit" name="submitattendance">
    </form>
</div>

<?php
    if(isset($_POST["submitattendance"])){
        $branchid = $_POST["branchid"];
        $staffid = $_POST["staffid"];
        $assignmentdate = $_POST["assignmentdate"];
        $timein = $_POST["timein"];
        $timeout = $_POST["timeout"];
        $note = $_POST["note"];
        $status = $_POST["status"];
        
        $conn = mysqli_connect("localhost", "root", "", "mamaflors");
        if(!$conn->connect_error){
            $sql = "INSERT INTO assignment(
                branch_ID,
                staff_ID,
                assignment_date,
                time_in,
                time_out,
                note,
                assignment_status
            )
            VALUES(
                '$branchid',
                '$staffid',
                '$assignmentdate',
                '$timein',
                '$timeout',
                '$note',
                '$status'
            )
            ";
            $conn->query($sql);
        }
        $conn->close();
    }
?>