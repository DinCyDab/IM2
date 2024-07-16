<?php
if($_SESSION["role"] == "Regular") {
    header("Location: indexstaff.php");
    exit();
}
?>
<?php
    if(isset($_POST["Update"])){
        $branchID = $_POST["branchID"];
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