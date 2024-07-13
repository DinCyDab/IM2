<div class="addStaffIndividually" id="addStaffIndividually">
    <button onclick="closeAddStaffIndie()">Close</button>
    <form method="post">
        <select name='staff_ID'>
            <?php 
                $conn = mysqli_connect("localhost","root","","mamaflors");
                if(!$conn->connect_error){
                    $sql = "SELECT
                                staff_ID,
                                CONCAT(last_name, ', ', first_name) AS 'staff_name'
                            FROM
                                staff
                            WHERE
                                status = 'Active'
                    ";
                    $result = $conn->query($sql);
                    $row = $result->fetch_all(MYSQLI_ASSOC);
                    if(sizeof($row) > 0){
                        for($x = 0; $x < sizeof($row); $x++){
                            echo "
                                    <option value='".$row[$x]["staff_ID"]."'>".$row[$x]["staff_ID"]." ".$row[$x]["staff_name"]."</option>
                            ";
                        }
                    }
                }
                $conn->close();
            ?>
        </select>
        <input type="submit" value="Add Staff" name="addstaffindividually">
    </form>
</div>

<script>
    function showAddStaffIndie(){
        var addStaffIndividually = document.getElementById("addStaffIndividually");
        addStaffIndividually.style.display = "block";
    }
    function closeAddStaffIndie(){
        var addStaffIndividually = document.getElementById("addStaffIndividually");
        addStaffIndividually.style.display = "none";
    }
</script>

<?php
    if(isset($_POST["addstaffindividually"])){
        $staffID = $_POST["staff_ID"];
        $date = $_SESSION["date"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if(!$conn->connect_error){
            $sql = "INSERT INTO assignment(
                staff_ID,
                assignment_date
            )
            VALUES(
                '$staffID',
                '$date'
            )
            ";
            $conn->query($sql);
        }
        $conn->close();
        header("Location: assignment.php?date=$date&filterAttendance=Filter");
        exit();
    }
?>