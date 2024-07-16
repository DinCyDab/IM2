<?php
if($_SESSION["role"] == "Regular") {
    header("Location: indexstaff.php");
    exit();
}
?>
<div class="addstaffholder" id="add">
    <div class="add-staff">
        <div style="display:flex">
            <h4>Add Staff Details</h4>
            <button onclick="hideAdd()">Close</button>
        </div>
        <div>
            <form class="add-staff-form" method="post">
                <div>
                    <h4>Staff ID:       </h4>
                    <input type="text" name="staff-ID" required>
                </div>
                <div>
                    <h4>Last Name:      </h4><input type="text" name="last-name" required>
                    <h4>First Name:     </h4><input type="text" name="first-name" required>
                    <h4>Middle Name:    </h4><input type="text" name="middle-name">
                </div>
                <div>
                    <h4>Birthday:       </h4><input type="date" name="birth-date">
                    <h4>Gender:         </h4><input type="text" name="gender">
                </div>
                <div>
                    <h4>House Number:   </h4><input type="text" name="house-number">
                    <h4>Street Name:    </h4><input type="text" name="street-name">
                    <h4>Barangay:       </h4><input type="text" name="barangay">
                    <h4>City:           </h4><input type="text" name="city">
                </div>
                <div>
                    <h4>Province:       </h4><input type="text" name="province">
                    <h4>Postal Code:    </h4><input type="text" name="postal-code">
                </div>
                <div>
                <h4>Contact Number:     </h4><input type="text" name="contact-number-1">
                <h4>Contact Number:     </h4><input type="text" name="contact-number-2">
                <h4>Email:              </h4><input type="text" name="email">
                </div>
                <div>
                    <h4>SSN:            </h4><input type="text" name="ssn">
                    <h4>TIN:            </h4><input type="text" name="tin">
                    <h4>Position:       </h4><input type="text" name="position">
                    <h4>Start Date:     </h4><input type="date" name="start-date">
                    <h4>Salary:         </h4><input type="text" name="salary">
                </div>
                <div>
                <h4>Status:</h4>
                    <select name="status">
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