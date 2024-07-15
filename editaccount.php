<?php
if($_SESSION["role"] != "Administrator"){
    header("Location: indexstaff.php");
    exit();
}
?>
<?php
    if(isset($_GET["edit"])){
        $editID = $_GET["edit"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "SELECT *, CONCAT(staff.last_name, ', ', staff.first_name, ' ', LEFT(staff.middle_name, 1), '.') AS 'staff_name'
                    FROM account
                        INNER JOIN staff ON account.account_ID = staff.staff_ID
                    WHERE account_ID = $editID";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row)>0){
                echo'
                    <div id="edit" class="editaccountholder">
                        <div class="edit-account">
                            <div style="display:flex">
                                <h4>Edit Account</h4>
                                <button class="button-close" onclick="hideEdit()">Close</button>
                            </div>
                            <div>
                                <form class="edit-account-form" method="post">
                                    <div>
                                        <h4>Account Name: '.$row[0]["staff_name"].'</h4>
                                    </div>
                                    <div>
                                        <h4>Role:</h4>
                                        <select name="role">
                                            <option value="Regular">Regular</option>
                                            <option value="Administrator">Administrator</option>
                                        </select>
                                    </div>
                                    <div>
                                        <h4>Account Status:</h4>
                                        <select name="status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <input type="submit" value="Update" name="Update">
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            }
            else{
                echo "No Product Listed";
            }
        }
        $conn->close();
    }
?>

<?php
    if(isset($_POST["Update"])){
        $role = $_POST["role"];
        $status = $_POST["status"];

        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "UPDATE account
                    SET
                        role = '$role',
                        account_status = '$status'
                    WHERE account_ID = $editID
                    ";
            $conn->query($sql);
        }
        $conn->close();
        header("Location: account.php");
        exit();
    }
?>