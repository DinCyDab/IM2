<div class="add-branch" id="add">
    <button onclick="hideAdd()">Close</button>
    <form method="post">
        Branch Name:        <input type="text" name="branchname" required>
        Established Date:   <input type="date" name="establisheddate">
        Street Name:        <input type="text" name="streetname">
        Barangay:           <input type="text" name="barangay">
        City:               <input type="text" name="city">
        Province:           <input type="text" name="province">
        Postal Code:        <input type="text" name="postalcode">
        Contact Number:     <input type="text" name="contactnumber">
        Status:
        <select name="branch-status">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        <input type="submit" value="Submit" name="Submit">
    </form>
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