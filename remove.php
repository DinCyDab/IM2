<?php
    if(isset($_GET["remove"])){
        $removeID = $_GET["removeID"];
        $tableName = $_GET["tableName"];
        $columnName = $_GET["columnName"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if($conn->connect_error){
            die("ERROR". $conn->connect_error);
        }
        else{
            $sql = "DELETE FROM $tableName
                    WHERE $columnName = $removeID";
            $conn->query($sql);
        }
        $conn->close();
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
?>