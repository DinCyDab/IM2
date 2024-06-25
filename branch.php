<!DOCTYPE html>
<html>
    <head>
        <style>
            .add-branch{
                display: none;
            }
            table{
                border-collapse: collapse;
            }
            th, tr{
                border: 1px aqua solid;
            }
            tr:nth-child(even){
                background-color: aqua;
            }
        </style>
    </head>
    <body>
        <a href="index.php">Home</a>
        <br>

        <button onclick="showAddBranch()">ADD</button>
        <button>REMOVE</button>
        <button>EDIT</button>

        <br>

        <?php 
            include "addbranch.php"
        ?>
        </table>

    </body>
    <script>
        function showAddBranch(){
            document.getElementById("add-branch").style.display = "block";
        }

        function hideAddBranch(){
            document.getElementById("add-branch").style.display = "none";
        }
    </script>
</html>

<?php
    $conn = mysqli_connect("localhost","root","","mamaflors");
    if($conn->connect_error){
        die("ERROR". $conn->connect_error);
    }
    else{
        $sql = "SELECT * FROM branch";
        $result = $conn->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if(sizeof($row) > 0){
            echo "
            <table>
                <tr>
                    <th>Branch ID</th>
                    <th>Branch Name</th>
                    <th>Established Date</th>
                    <th>Street Name</th>
                    <th>Barangay</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Postal Code</th>
                    <th>Contact Number</th>
                    <th>Branch Status</th>
                </tr>";
            for($x = 0; $x < sizeof($row); $x++){
                echo
                    "<tr>
                        <td>".$row[$x]['branch_ID']."</td>
                        <td>".$row[$x]['branch_name']."</td>
                        <td>".$row[$x]['established_date']."</td>
                        <td>".$row[$x]['street_name']."</td>
                        <td>".$row[$x]['barangay']."</td>
                        <td>".$row[$x]['city']."</td>
                        <td>".$row[$x]['province']."</td>
                        <td>".$row[$x]['postal_code']."</td>
                        <td>".$row[$x]['contact_number']."</td>
                        <td>".$row[$x]['branch_status']."</td>
                    </tr>";
            }
            echo "</table>";
        }
        else{
            echo "DATABASE EMPTY";
        }
    }
    $conn->close();
?>