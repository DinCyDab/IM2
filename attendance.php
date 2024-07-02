<!DOCTYPE html>
<html>
    <head>
        <style>
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

        <button>ADD</button>
        <button>REMOVE</button>
        <button>EDIT</button>

        <br>

        <?php
            include "addattendance.php";
        ?>
    </body>
</html>
<table>
    <?php
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if(!$conn->connect_error){
            $sql = "SELECT * FROM assignment";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row) > 0){
                echo "<tr>
                    <th></th>
                    <th></th>
                    <th>Assignment ID</th>
                    <th>Branch ID</th>
                    <th>Staff ID</th>
                    <th>Assignment Date</th>
                    <th>Time in</th>
                    <th>Time out</th>
                    <th>Note</th>
                    <th>Status</th>
                </tr>";
                for($x = 0; $x < sizeof($row); $x++){
                    echo "<tr>
                        <td>
                            <form method='get'>
                                <input type='hidden' value='".($row[$x]['branch_ID'])."' name='edit'>
                                <button class='edit-product-row' id='edit-product-row$x' type='submit'>EDIT</button>
                            </form>
                        </td>
                        <td><form method='get'>
                                <input type='hidden' value='".($row[$x]['branch_ID'])."' name='remove'>
                                <button class='remove-product' id='remove-product$x'>Remove</button>
                            </form>
                        </td>
                        <td>".$row[$x]['assignment_ID']."</td>
                        <td>".$row[$x]['branch_ID']."</td>
                        <td>".$row[$x]['staff_ID']."</td>
                        <td>".$row[$x]['assignment_date']."</td>
                        <td>".$row[$x]['time_in']."</td>
                        <td>".$row[$x]['time_out']."</td>
                        <td>".$row[$x]['note']."</td>
                        <td>".$row[$x]['assignment_status']."</td>
                    </tr>";
                }
            }
        }
        $conn->close();
    ?>
</table>