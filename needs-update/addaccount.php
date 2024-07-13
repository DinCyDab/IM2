<?php
if($_SESSION["role"] != "Administrator"){
    header("Location: indexstaff.php");
    exit();
}
?>
<div id="add" class="addaccountholder">
    <div class="add-account">
        <div class="headerholder">
            <h1>Add Account</h1>
            <button class="button-close" onclick="hideAdd()">Close</button>
        </div>
        <form class="addaccountform" method="post">
            <div class="accountidholder">
                <h2>Choose Staff:</h2>
                <div>
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
                </div>
            </div>
            <div>
                <h2>Password:</h2>
                <div>
                    <input class="subdiv" type="password" name="pass" required>
                </div>
            </div>
            <div>
                <h2>Role:</h2>
                <div>
                    <select name="role">
                        <option value="Regular">Regular</option>
                        <option value="Administrator">Administrator</option>
                    </select>
                </div>
            </div>
            <div>
                <h2>Account Status:</h2>
                <div>
                    <select name="accountstatus">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="submitHolder">
                <input type="submit" value="Submit" name="Submit">
            </div>
        </form>
    </div>
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