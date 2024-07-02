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
                    <div id="edit" class="edit-branch">
                    <button onclick="hideEdit()">Close</button>
                    <form method="post">
                        Branch Name:        <input type="text" value="'.$row[0]["branch_name"].'" name="branchname" required>
                        Established Date:   <input type="date" value="'.$row[0]["established_date"].'" name="establisheddate">
                        Street Name:        <input type="text" value="'.$row[0]["street_name"].'" name="streetname">
                        Barangay:           <input type="text" value="'.$row[0]["barangay"].'" name="barangay">
                        City:               <input type="text" value="'.$row[0]["city"].'" name="city">
                        Province:           <input type="text" value="'.$row[0]["province"].'" name="province">
                        Postal Code:        <input type="text" value="'.$row[0]["postal_code"].'" name="postalcode">
                        Contact Number:     <input type="text" value="'.$row[0]["contact_number"].'" name="contactnumber">
                        Status:
                        <select name="branch-status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <input type="submit" value="Update" name="Update">
                    </form>
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