<?php
if ($_SESSION["role"] == "Regular") {
    header("Location: indexstaff.php");
    exit();
}
?>
<div id="add" class="addaccountholder">
    <div class="add-account">
        <div style="display:flex">
            <h4>Add Account</h4>
            <button class="button-close" onclick="hideAdd()">Close</button>
        </div>
        <div>
            <form class="add-account-form" method="post" onsubmit="return validateAddForm()" id="addform">
                <div>
                    <h4>Choose Staff:</h4>
                    <select name="accountid" required>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "mamaflors");
                        if (!$conn->connect_error) {
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
                            if (sizeof($row) > 0) {
                                for ($x = 0; $x < sizeof($row); $x++) {
                                    echo "<option value='".$row[$x]['staff_ID']."'>".$row[$x]['staff_ID']." ".$row[$x]['staff_name']."</option>";
                                }
                            }
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div>
                    <h4>Password:</h4>
                    <input class="subdiv" type="password" name="pass" required>
                </div>
                <?php
                if ($_SESSION["role"] == "Owner") {
                    echo '
                            <div>
                                <h4>Role:</h4>
                                <select name="role">
                                    <option value="Regular">Regular</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                            </div>
                        ';
                }
                if ($_SESSION["role"] == "Administrator") {
                    echo '
                            <div>
                                <h4>Role:</h4>
                                <input name="role" value="Regular" readonly>
                            </div>
                        ';
                }
                ?>
                <div>
                    <h4>Account Status:</h4>
                    <select name="accountstatus">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="submitHolder">
                    <input type="submit" value="Submit">
                    <input type="hidden" value="Submit" name="Submit">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST["Submit"])) {
    $accountid = $_POST["accountid"];
    $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
    $role = $_POST["role"];
    $status = $_POST["accountstatus"];
    $conn = mysqli_connect("localhost", "root", "", "mamaflors");

    $result = $conn->query("SELECT * FROM account WHERE account_ID = '$accountid'");
    $row = $result->fetch_all(MYSQLI_ASSOC);
    if (sizeof($row) > 0) {
        include "errorfolder/noDuplicateAcc.php";
    } else {
        if ($conn->connect_error) {
            die("ERROR".$conn->connect_error);
        } else {
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
}
include "confirmationfolder/confirmationadd.php";
?>