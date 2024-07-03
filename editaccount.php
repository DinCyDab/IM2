<?php
    if(isset($_GET["edit"])){
        $editID = $_GET["edit"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "SELECT * FROM account
                    WHERE account_ID = $editID";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row)>0){
                echo'
                    <div id="edit" class="edit-product">
                        <button onclick="hideEdit()">Close</button>
                        <form method="post">
                            Role:
                            <select name="role">
                                <option value="Regular">Regular</option>
                                <option value="Administrator">Administrator</option>
                            </select>
                            Account Status:
                            <select name="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <input type="submit" value="Update" name="Update">
                        </form>
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