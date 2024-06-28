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
            
        }
        else{
            echo "EMPTY DATABASE";
        }
    }
    $conn->close();
?>