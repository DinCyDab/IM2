<div>
    <form method="post">
        Account ID:
        <select name="accountid" required>
            <!-- for loop here -->
            <option value="0002">0001</option>
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