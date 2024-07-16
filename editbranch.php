<?php
if($_SESSION["role"] == "Regular") {
    header("Location: indexstaff.php");
    exit();
}
?>
<?php
    if(isset($_GET["edit"])){
        $valueToEdit = $_GET["edit"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error) {
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "SELECT * FROM branch
                    WHERE branch_ID = $valueToEdit";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row) > 0){
                echo '
                    <div id="edit" class="editbranchholder">
                        <div class="edit-branch">
                            <div style="display:flex">
                                <h4>Edit Branch Details</h4>
                                <button onclick="hideEdit()">Close</button>
                            </div>
                            <div>
                                <form class="edit-branch-form" method="post">
                                    <div>
                                        <h4>Branch Name:        </h4>
                                        <input type="text" value="'.$row[0]["branch_name"].'" name="branchname" required>
                                        <h4>Established Date:   </h4>
                                        <input type="date" value="'.$row[0]["established_date"].'" name="establisheddate">
                                    </div>
                                    <div>
                                        <h4>Street Name:        </h4>
                                        <input type="text" value="'.$row[0]["street_name"].'" name="streetname">
                                        
                                        <h4>Barangay:           </h4>
                                        <input type="text" value="'.$row[0]["barangay"].'" name="barangay">

                                    </div>
                                    <div>
                                        <h4>City:               </h4>
                                        <input type="text" value="'.$row[0]["city"].'" name="city">
                                        <h4>Province:           </h4>
                                        <input type="text" value="'.$row[0]["province"].'" name="province">
                                        
                                        
                                    </div>
                                    <div>
                                        <h4>Postal Code:        </h4>
                                        <input type="text" value="'.$row[0]["postal_code"].'" name="postalcode">
                                        <h4>Contact Number:     </h4>
                                        <input type="text" value="'.$row[0]["contact_number"].'" name="contactnumber">
                                    </div>
                                    <div>
                                        <h4>Status:</h4>
                                        <select name="branch-status">
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
        }
        $conn->close();
    }
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Update"])){
        $branchname = $_POST["branchname"];
        $establisheddate = $_POST["establisheddate"];
        $streetname = $_POST["streetname"];
        $barangay = $_POST["barangay"];
        $city = $_POST["city"];
        $province = $_POST["province"];
        $postalcode = $_POST["postalcode"];
        $contactnumber = $_POST["contactnumber"];
        $branchstatus = $_POST["branch-status"];

        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "UPDATE branch
                    SET
                        branch_name = '$branchname',
                        established_date = '$establisheddate',
                        street_name = '$streetname',
                        barangay = '$barangay',
                        city = '$city',
                        province = '$province',
                        postal_code = '$postalcode',
                        contact_number = '$contactnumber',
                        branch_status = '$branchstatus'
                    WHERE branch_ID = $valueToEdit;
            ";
            $conn->query($sql);
        }
        $conn->close();
        header("Location: branch.php");
        exit();
    }
?>