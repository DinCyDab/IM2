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
                    <div id="edit" class="editAccountHolder">
                        <div class="editAccount">
                            <div class="headerholder">
                                <h1>Edit Account</h1>
                                <button class="button-close" onclick="hideEdit()">Close</button>
                            </div>
                            <div class="headerholder">
                                <h2>Account Name: '.$row[0]["staff_name"].'</h2>
                                <button class="button-close" onclick="hideEdit()">Close</button>
                            </div>
                            <form class="editaccountform" method="post">
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
                                        <select name="status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="submit" value="Update" name="Update">
                            </form>
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