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
                        <th></th>
                        <th></th>
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
                        <td>
                            <form method='get'>
                                <input type='hidden' value='".($row[$x]['staff_ID'])."' name='edit'>
                                <button class='edit-product-row' id='edit-product-row$x' type='submit'>EDIT</button>
                            </form>
                        </td>
                        <td><form method='get'>
                                <input type='hidden' value='".($row[$x]['staff_ID'])."' name='remove'>
                                <button class='remove-product' id='remove-product$x'>Remove</button>
                            </form>
                        </td>
                        <td>".$row[$x]['staff_ID']."</td>
                        <td>".$row[$x]['last_name']."</td>
                        <td>".$row[$x]['first_name']."</td>
                        <td>".$row[$x]['middle_name']."</td>
                        <td>".$row[$x]['house_number']."</td>
                        <td>".$row[$x]['street_name']."</td>
                        <td>".$row[$x]['barangay']."</td>
                        <td>".$row[$x]['city']."</td>
                        <td>".$row[$x]['province']."</td>
                        <td>".$row[$x]['postal_code']."</td>
                        <td>".$row[$x]['birth_date']."</th>
                        <td>".$row[$x]['gender']."</td>
                        <td>".$row[$x]['contact_1']."</td>
                        <td>".$row[$x]['contact_2']."</td>
                        <td>".$row[$x]['email']."</td>
                        <td>".$row[$x]['SSN']."</td>
                        <td>".$row[$x]['TIN']."</td>
                        <td>".$row[$x]['position_title']."</td>
                        <td>".$row[$x]['start_date']."</td>
                        <td>".$row[$x]['salary']."</td>
                        <td>".$row[$x]['status']."</td>
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