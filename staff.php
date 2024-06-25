<!DOCTYPE html>
<html>
    <head>
        <style>
            .add-staff{
                display: none;
            }
            table{
                border-collapse: collapse;
            }
            th, tr{
                border: 1px aquamarine solid;
            }
            tr:nth-child(even){
                background-color: aqua;
            }
        </style>
    </head>
    <body>
        <a href="index.php">Home</a>

        <br>

        <button onclick="showAddStaff()">ADD</button>
        <button>REMOVE</button>
        <button>EDIT</button>

        <br>

        <?php 
            include "addstaff.php"
        ?>
    </body>
    <script>
        function showAddStaff(){
            document.getElementById("add-staff").style.display = "block";
        }
    </script>
</html>

<?php 
    //Connect to db
    $conn = mysqli_connect("localhost","root","","mamaflors");
    if ($conn->connect_error) {
        die("ERROR". $conn->connect_error);
    }
    else{
        //Retrieve Data from staff table
        $sql = "SELECT * FROM staff";
        $result = $conn->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if(sizeof($row) > 0){
            echo "
                <table>
                    <tr>
                        <th>Staff ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>House Number</th>
                        <th>Street Name</th>
                        <th>Barangay</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Postal Code</th>
                        <th>Birthdate</th>
                        <th>Gender</th>
                        <th>Contact Number(1)</th>
                        <th>Contact Number(2)</th>
                        <th>Email</th>
                        <th>SSN</th>
                        <th>TIN</th>
                        <th>Position Title</th>
                        <th>Start Date</th>
                        <th>Salary</th>
                        <th>Status</th>
                    </tr>
                ";
            for($x = 0; $x < sizeof($row); $x++){
                echo "
                    <tr>
                        <th>".$row[$x]['staff_ID']."</th>
                        <th>".$row[$x]['last_name']."</th>
                        <th>".$row[$x]['first_name']."</th>
                        <th>".$row[$x]['middle_name']."</th>
                        <th>".$row[$x]['house_number']."</th>
                        <th>".$row[$x]['street_name']."</th>
                        <th>".$row[$x]['barangay']."</th>
                        <th>".$row[$x]['city']."</th>
                        <th>".$row[$x]['province']."</th>
                        <th>".$row[$x]['postal_code']."</th>
                        <th>".$row[$x]['birth_date']."</th>
                        <th>".$row[$x]['gender']."</th>
                        <th>".$row[$x]['contact_1']."</th>
                        <th>".$row[$x]['contact_2']."</th>
                        <th>".$row[$x]['email']."</th>
                        <th>".$row[$x]['SSN']."</th>
                        <th>".$row[$x]['TIN']."</th>
                        <th>".$row[$x]['position_title']."</th>
                        <th>".$row[$x]['start_date']."</th>
                        <th>".$row[$x]['salary']."</th>
                        <th>".$row[$x]['status']."</th>
                    </tr>
                ";
            }
            echo "</table>";
        }
        else{
            echo "Database is Empty";
        }
    }
    $conn->close();
?>