<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <a href="index.php">Home</a>

        <br>

        <button>ADD</button>
        <button>REMOVE</button>
        <button>EDIT</button>

        <br>
        <?php
            include "addaccount.php";
        ?>
    </body>
</html>

<?php
    //Retrieve account sql
    $conn = mysqli_connect("localhost","root","","mamaflors");
    if($conn->connect_error){
        die("ERROR". $conn->connect_error);
    }
    else{
        $sql = "SELECT * FROM account";
        $result = $conn->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if(sizeof($row) > 0){
            echo "<table>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Account ID</th>
                    <th>Created Date</th>
                    <th>Created Time</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Account Status</th>
                </tr>
            ";
            for($x = 0; $x < sizeof($row); $x++){
                echo "
                    <tr>
                        <td>Remove</td>
                        <td>Edit</td>
                        <td>".$row[$x]["account_ID"]."</td>
                        <td>".$row[$x]["created_date"]."</td>
                        <td>".$row[$x]["created_time"]."</td>
                        <td>".$row[$x]["password"]."</td>
                        <td>".$row[$x]["role"]."</td>
                        <td>".$row[$x]["account_status"]."</td>
                    </tr>
                ";
            }
            echo "</table>";
        }
        else{
            echo "EMPTY DATABASE";
        }
    }
    $conn->close();
?>