<?php
if($_SESSION["role"] != "Administrator"){
    header("Location: indexstaff.php");
    exit();
}
?>
<div class="addbranchholder" id="add">
    <div class="add-branch">
        <div style="display:flex">
            <h4>Add Branch Details</h4>
            <button onclick="hideAdd()">Close</button>
        </div>
        <div>
            <form class="add-branch-form" method="post">
                <div>
                    <h4>Branch Name:</h4>
                    <input type="text" name="branchname" required>
                    <h4>Established Date:   </h4>
                    <input type="date" name="establisheddate">
                </div>
                <div>
                    <h4>Street Name:        </h4>
                    <input type="text" name="streetname">
                    <h4>Barangay:           </h4>
                    <input type="text" name="barangay">
                </div>
                <div>
                    <h4>City:               </h4>
                    <input type="text" name="city"> 
                    <h4>Province:           </h4>
                    <input type="text" name="province">
                </div>
                <div>
                    <h4>Postal Code:        </h4>
                    <input type="text" name="postalcode">
                    <h4>Contact Number:     </h4>
                    <input type="text" name="contactnumber">
                </div>
                <div>
                    <h4>Status:</h4>
                    <select name="branch-status">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <input type="submit" value="Submit" name="Submit">
            </form>
        </div>
    </div>
</div>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Submit"])){
        $branchname = $_POST["branchname"];
        $establisheddate = $_POST["establisheddate"];
        $streetname = $_POST["streetname"];
        $barangay = $_POST["barangay"];
        $city = $_POST["city"];
        $province = $_POST["province"];
        $postalcode = $_POST["postalcode"];
        $contactnumber = $_POST["contactnumber"];
        $branchstatus = $_POST["branch-status"];
        //Connect to DB
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "INSERT INTO branch(
                branch_name,
                established_date,
                street_name,
                barangay,
                city,
                province,
                postal_code,
                contact_number,
                branch_status
            )
            VALUES(
                '$branchname',
                '$establisheddate',
                '$streetname',
                '$barangay',
                '$city',
                '$province',
                '$postalcode',
                '$contactnumber',
                '$branchstatus'
            )";
            $conn->query($sql);
        }
        $conn->close();
        header("Location: branch.php");
        exit();
    }
?>