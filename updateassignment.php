<?php
    if(isset($_POST["Update"])){
        $branchID = $_POST["branchID"];
        $timein = $_POST["timein"];
        $timeout = $_POST["timeout"];
        $note = $_POST["note"];
        $status = $_POST["status"];

        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "UPDATE assignment
                    SET
                        branch_ID = '$branchID',
                        time_in = '$timein',
                        time_out = '$timeout',
                        note = '$note',
                        assignment_status = '$status'
                    WHERE assignment_ID = $assignmentID
                    ";
            $conn->query($sql);
        }
        $conn->close();
        header("Location: assignment.php");
        exit();
    }
?>