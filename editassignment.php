<?php
if($_SESSION["role"] == "Regular") {
    header("Location: indexstaff.php");
    exit();
}
?>

 

<?php
    if(isset($_GET["edit"])){
        $assignmentID = $_GET["edit"];
        $date = "date=".$_GET["date"]."&filterAttendance=Filter";
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "SELECT
                        assignment.*,
                        CONCAT(staff.last_name, ', ', staff.first_name, ' ', staff.middle_name) AS 'staff_name',
                        branch.branch_ID
                    FROM
                        (assignment
                        INNER JOIN staff ON assignment.staff_ID = staff.staff_ID)
                        LEFT JOIN branch ON assignment.branch_ID = branch.branch_ID
                    WHERE
                        assignment_ID = $assignmentID";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(isset($row[0]["branch_ID"])){
                $branchValue = $row[0]["branch_ID"];
            }

            $sql = "SELECT
                        *
                    FROM
                        branch
                    WHERE
                        branch_status = 'Active'
            ";
            $result = $conn->query($sql);
            $rowBranch = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row)>0){
                echo'
                    <div id="edit" class="editassignmentholder">
                        <div class="edit-assignment">
                            <div>
                                <button onclick="hideEdit()">Close</button>
                            </div>
                            <div>
                                <form method="post" class="edit-assignment-form" onsubmit="return validateEditForm()" id="editform">
                                    <div>
                                        <h4>Staff ID:</h4>       <input type="text" name="staffID" value="'.$row[0]["staff_ID"].'" readonly>
                                        <h4>Staff Name:</h4>     <input type="text" name="staffName" value="'.$row[0]["staff_name"].'" readonly>
                                    </div>
                                    <div>
                                        <h4>Branch ID:</h4>
                                        <select name="branchID">
                                        ';
                                        echo"<option value='NULL'>No Branch Assignment</option>";
                                        for($x = 0; $x < sizeof($rowBranch); $x++){
                                            $selected = "";
                                            if(isset($branchValue) && $branchValue == $rowBranch[$x]["branch_ID"]){
                                                $selected = "selected";
                                            }
                                            echo '
                                                <option value="'.$rowBranch[$x]['branch_ID'].'"'.$selected.'>'.$rowBranch[$x]['branch_ID'].' '. $rowBranch[$x]['branch_name'].'</option>
                                            ';
                                        }
                                        echo '
                                        </select>
                                    </div>
                                    <div>
                                        <h4>Note:</h4>
                                        <input type="text" name="note" value="'.$row[0]["note"].'">
                                    </div>
                                    <input type="submit" value="Update" class="button">
                                    <input type="hidden" value="Update" name="Update">
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            }
        }
        $conn->close();
    }
?>
 

<?php
    if(isset($_POST["Update"])){
        $branchID = $_POST["branchID"];
        $note = $_POST["note"];
        if($branchID == "NULL"){
            $status = "";
        }
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "UPDATE assignment
                    SET
                        branch_ID = ".($branchID == "NULL" ? "NULL":$branchID).",
                        note = '$note'
                    WHERE assignment_ID = $assignmentID
                    ";
            $conn->query($sql);
        }
        $conn->close();
        header("Location: assignment.php?".$date);
        exit();
    }
    include "confirmationfolder/confirmationedit.php";
?>
