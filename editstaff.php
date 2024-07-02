<?php
    if(isset($_GET["edit"])){
        $valueToEdit = $_GET["edit"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error) {
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "SELECT * FROM staff
                    WHERE staff_ID = $valueToEdit";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row) > 0){
                echo '
                    <div id="edit" class="edit-branch">
                    <button onclick="hideEdit()">Close</button>
                    <form method="post">
                        Staff ID:       <input type="text" value="'.$row[0]['staff_ID'].'" name="staff-ID" required>
                        Last Name:      <input type="text" value="'.$row[0]['last_name'].'" name="last-name" required>
                        First Name:     <input type="text" value="'.$row[0]['first_name'].'" name="first-name" required>
                        Middle Name:    <input type="text" value="'.$row[0]['middle_name'].'" name="middle-name"required>
                        House Number:   <input type="text" value="'.$row[0]['house_number'].'" name="house-number">
                        Street Name:    <input type="text" value="'.$row[0]['street_name'].'" name="street-name">
                        Barangay:       <input type="text" value="'.$row[0]['barangay'].'" name="barangay">
                        City:           <input type="text" value="'.$row[0]['city'].'" name="city">
                        Province:       <input type="text" value="'.$row[0]['province'].'" name="province">
                        Postal Code:    <input type="text" value="'.$row[0]['postal_code'].'" name="postal-code">
                        Birthday:       <input type="date" value="'.$row[0]['birth_date'].'" name="birth-date">
                        Gender:         <input type="text" value="'.$row[0]['gender'].'" name="gender">
                        Contact Number: <input type="text" value="'.$row[0]['contact_1'].'" name="contact-number-1">
                        Contact Number: <input type="text" value="'.$row[0]['contact_2'].'" name="contact-number-2">
                        Email:          <input type="text" value="'.$row[0]['email'].'" name="email">
                        SSN:            <input type="text" value="'.$row[0]['SSN'].'" name="ssn">
                        TIN:            <input type="text" value="'.$row[0]['TIN'].'" name="tin">
                        Position:       <input type="text" value="'.$row[0]['position_title'].'" name="position">
                        Start Date:     <input type="date" value="'.$row[0]['start_date'].'" name="start-date">
                        Salary:         <input type="text" value="'.$row[0]['salary'].'" name="salary">
                        Status:
                        <select name="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <input type="submit" value="Submit">
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