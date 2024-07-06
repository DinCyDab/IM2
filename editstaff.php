<?php
if($_SESSION["role"] != "Administrator"){
    header("Location: indexstaff.php");
    exit();
}
?>
<?php
    if(isset($_GET["edit"])){
        $valueToEdit = $_GET["edit"];
        echo "$valueToEdit\n\n";
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
                        <input type="submit" value="Submit" name="Update">
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
        $staffid = $_POST["staff-ID"];
        $lastname = $_POST["last-name"];
        $firstname = $_POST["first-name"];
        $middlename = $_POST["middle-name"];
        $housenumber = $_POST["house-number"];
        $streetname = $_POST["street-name"];
        $barangay = $_POST["barangay"];
        $city = $_POST["city"];
        $province = $_POST["province"];
        $postalcode = $_POST["postal-code"];
        $birthday = $_POST["birth-date"];
        $gender = $_POST["gender"];
        $contact1 = $_POST["contact-number-1"];
        $contact2 = $_POST["contact-number-2"];
        $email = $_POST["email"];
        $ssn = $_POST["ssn"];
        $tin = $_POST["tin"];
        $position = $_POST["position"];
        $startdate = $_POST["start-date"];
        $salary = $_POST["salary"];
        $status = $_POST["status"];

        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "UPDATE staff
                    SET
                        staff_ID = '$staffid',
                        last_name = '$lastname',
                        first_name = '$firstname',
                        middle_name = '$middlename',
                        house_number = '$housenumber',
                        street_name = '$streetname',
                        barangay = '$barangay',
                        city = '$city',
                        province = '$province',
                        postal_code = '$postalcode',
                        birth_date = '$birthday',
                        gender = '$gender',
                        contact_1 = '$contact1',
                        contact_2 = '$contact2',
                        email = '$email',
                        SSN = '$ssn',
                        TIN = '$tin',
                        position_title = '$position',
                        start_date = '$startdate',
                        salary = '$salary',
                        status = '$status'
                    WHERE staff_ID = $valueToEdit;
            ";
            $conn->query($sql);
        }
        $conn->close();
        header("Location: staff.php");
        exit();
    }
?>