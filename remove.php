<?php
    if(isset($_GET["remove"])){
        $query = "";
        if(isset($_GET["date"])){
            $query = "date=".$_GET["date"]."&filterAttendance=Filter";
        }
        // if(isset($_SESSION["chosendate"])){
        //     $query = "filterdate=".$_SESSION["chosendate"];
        // }
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
        if(isset($_GET["staffpendingreports"])){
            $tableName = $_GET["staffpendingreports"];
        }
        header("Location: " . $tableName.".php?".$query);
        exit();
    }
?>