<div id="add" class="add-account">
    <button onclick="hideAdd()">Close</button>
    <form method="post">
        Account ID:
        <select name="accountid" required>
            <?php
                $conn = mysqli_connect("localhost","root","","mamaflors");
                if(!$conn->connect_error){
                    $sql = "SELECT 
                                staff_ID,
                                CONCAT(last_name, ', ', first_name, ' ', middle_name) AS 'staff_name'
                            FROM 
                                staff
                            WHERE
                                status = 'Active'
                            ";
                    $result = $conn->query($sql);
                    $row = $result->fetch_all(MYSQLI_ASSOC);
                    if(sizeof($row) > 0){
                        for($x = 0; $x < sizeof($row); $x++){
                            echo "<option value='".$row[$x]['staff_ID']."'>".$row[$x]['staff_ID']." ".$row[$x]['staff_name']."</option>";
                        }
                    }
                }
                $conn->close();
            ?>
        </select>
        Password: <input type="password" name="pass" required>
        Role:
        <select name="role">
            <option value="Regular">Regular</option>
            <option value="Administrator">Administrator</option>
        </select>
        Account Status:
        <select name="accountstatus">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        <input type="submit" value="Submit" name="Submit">
    </form>
</div>

<?php
    if(isset($_POST["Submit"])){
        $accountid = $_POST["accountid"];
        $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
        $role = $_POST["role"];
        $status = $_POST["accountstatus"];
        $conn = mysqli_connect("localhost", "root", "", "mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "INSERT INTO account(
                        account_ID,
                        password,
                        role,
                        account_status)
                    VALUES(
                        '$accountid',
                        '$pass',
                        '$role',
                        '$status'
                    )";
            $conn->query($sql);
        }
        $conn->close();
    }
?>