<?php
if($_SESSION["role"] != "Administrator"){
    header("Location: indexstaff.php");
    exit();
}
?>
<div class="addattendanceholder" id="add">
    <div class="add-attendance">
        <div style="display:flex">
            <h4>Choose Date</h4>
            <button onclick="hideAdd()">Close</button>
        </div>
        <div>
            <form method="post" class="add-attendance-form">
                <div>
                    <h4>Assignment Date:</h4> <input type="date" name="assignmentdate">
                </div>
                <input type="submit" value="Create Attendance" name="createattendance">
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST["createattendance"])){
        $assignmentdate = $_POST["assignmentdate"];
        $conn = mysqli_connect("localhost", "root", "", "mamaflors");

        if(!$conn->connect_error){
            $sql = "SELECT
                        staff_ID
                    FROM
                        staff
                    WHERE
                        status = 'Active'
                        ";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row) > 0){
                for($x = 0; $x < sizeof($row); $x++){
                    $sql = "INSERT INTO assignment(
                        staff_ID,
                        assignment_date
                    )
                    VALUES(
                        '".$row[$x]['staff_ID']."',
                        '$assignmentdate'
                    )
                    ";
                    $conn->query($sql);
                }
            }
        }
        $conn->close();
        header("Location: assignment.php?date=".$_SESSION["date"]."&filterAttendance=Filter");
        exit();
    }
?>