<div class="add-staff" id="add">
    <button onclick="hideAdd()">Close</button>
    <form method="post">
        Staff ID:       <input type="text" name="staff-ID" required>
        Last Name:      <input type="text" name="last-name" required>
        First Name:     <input type="text" name="first-name" required>
        Middle Name:    <input type="text" name="middle-name"required>
        House Number:   <input type="text" name="house-number">
        Street Name:    <input type="text" name="street-name">
        Barangay:       <input type="text" name="barangay">
        City:           <input type="text" name="city">
        Province:       <input type="text" name="province">
        Postal Code:    <input type="text" name="postal-code">
        Birthday:       <input type="date" name="birth-date">
        Gender:         <input type="text" name="gender">
        Contact Number: <input type="text" name="contact-number-1">
        Contact Number: <input type="text" name="contact-number-2">
        Email:          <input type="text" name="email">
        SSN:            <input type="text" name="ssn">
        TIN:            <input type="text" name="tin">
        Position:       <input type="text" name="position">
        Start Date:     <input type="date" name="start-date">
        Salary:         <input type="text" name="salary">
        Status:
        <select name="status">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        <input type="submit" value="Submit" name="Submit">
    </form>
</div>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Submit'])){
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

        //Connect to db
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "INSERT INTO staff(
                staff_ID,
                last_name,
                first_name,
                middle_name,
                house_number,
                street_name,
                barangay,
                city,
                province,
                postal_code,
                birth_date,
                gender,
                contact_1,
                contact_2,
                email,
                SSN,
                TIN,
                position_title,
                start_date,
                salary,
                status
            )
            VALUES(
                '$staffid',
                '$lastname',
                '$firstname',
                '$middlename',
                '$housenumber',
                '$streetname',
                '$barangay',
                '$city',
                '$province',
                '$postalcode',
                '$birthday',
                '$gender',
                '$contact1',
                '$contact2',
                '$email',
                '$ssn',
                '$tin',
                '$position',
                '$startdate',
                '$salary',
                '$status'
            )";
            $conn->query($sql);
        }
        $conn->close();
        header("Location: staff.php");
        exit();
    }
?>