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
                    <tr>Account ID</tr>
                    <tr>Created Date</tr>
                    <tr>Created Time</tr>
                    <tr>Password</tr>
                    <tr>Role</tr>
                    <tr>Account</tr>
                </tr>
            ";
            for($x = 0; $x < sizeof($row); $x++){
                
            }
            echo "</table>";
        }
        else{
            echo "EMPTY DATABASE";
        }
    }
    $conn->close();
?>