<div id="add" class="add-attendance">
    <button onclick="hideAdd()">Close</button>
    <form method="post">
        Assignment Date: <input type="date" name="assignmentdate">
        <input type="submit" value="Create Attendance" name="createattendance">
    </form>
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
        // header("Location: assignment.php");
        // exit();
    }
?>