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
            $sql = "SELECT * FROM staff
                    WHERE staff_ID = $valueToEdit";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row) > 0){
                echo '
                    <div id="edit" class="editstaffholder">
                        <div class="edit-staff">
                            <div style="display:flex">
                                <h4>Edit Staff Details</h4>
                                <button onclick="hideEdit()">Close</button>
                            </div>
                            <div>
                                <form class="edit-staff-form" method="post">
                                    <div>
                                        <h4>Staff ID:       </h4>
                                        <input type="text" value="'.$row[0]['staff_ID'].'" name="staff-ID" readonly>
                                    </div>
                                    <div>
                                        <h4>Last Name:      </h4><input type="text" value="'.$row[0]['last_name'].'" name="last-name" required>
                                        <h4>First Name:     </h4><input type="text" value="'.$row[0]['first_name'].'" name="first-name" required>
                                        <h4>Middle Name:    </h4><input type="text" value="'.$row[0]['middle_name'].'" name="middle-name">
                                    </div>
                                    <div>
                                        <h4>Birthday:       </h4><input type="date" value="'.$row[0]['birth_date'].'" name="birth-date">
                                        <h4>Gender:         </h4><input type="text" value="'.$row[0]['gender'].'" name="gender">
                                    </div>
                                    <div>
                                        <h4>House Number:   </h4><input type="text" value="'.$row[0]['house_number'].'" name="house-number">
                                        <h4>Street Name:    </h4><input type="text" value="'.$row[0]['street_name'].'" name="street-name">
                                        <h4>Barangay:       </h4><input type="text" value="'.$row[0]['barangay'].'" name="barangay">
                                        <h4>City:           </h4><input type="text" value="'.$row[0]['city'].'" name="city">
                                    </div>
                                    <div>
                                        <h4>Province:       </h4><input type="text" value="'.$row[0]['province'].'" name="province">
                                        <h4>Postal Code:    </h4><input type="text" value="'.$row[0]['postal_code'].'" name="postal-code">
                                    </div>
                                    <div>
                                        <h4>Contact Number:     </h4><input type="text" value="'.$row[0]['contact_1'].'" name="contact-number-1">
                                        <h4>Contact Number:     </h4><input type="text" value="'.$row[0]['contact_2'].'" name="contact-number-2">
                                        <h4>Email:              </h4><input type="text" value="'.$row[0]['email'].'" name="email">
                                    </div>
                                    <div>
                                        <h4>SSN:            </h4><input type="text" value="'.$row[0]['SSN'].'" name="ssn">
                                        <h4>TIN:            </h4><input type="text" value="'.$row[0]['TIN'].'" name="tin">
                                        <h4>Position:       </h4><input type="text" value="'.$row[0]['position_title'].'" name="position">
                                        <h4>Start Date:     </h4><input type="date" value="'.$row[0]['start_date'].'" name="start-date">
                                        <h4>Salary:         </h4><input type="text" value="'.$row[0]['salary'].'" name="salary">
                                    </div>
                                    <div>
                                        <h4>Status:</h4>
                                        <select name="status">
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