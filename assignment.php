<?php
    ob_start();
    session_start();
    if($_SESSION["role"] != "Administrator"){
        header("Location: indexstaff.php");
    }
    if(!isset($_SESSION["session_started"])){
        $_SESSION["session_started"] = TRUE;
        $_SESSION["showEdit"] = FALSE;
        $_SESSION["showRemove"] = FALSE;
    }
    if(!isset($_SESSION["SORT"])){
        $_SESSION["SORT"] = "DESC";
    }

    if(!isset($_SESSION["date"])){
        $_SESSION["date"] = date("Y-m-d");
    }
    else{
        if(isset($_GET["date"])){
            $_SESSION["date"] = $_GET["date"];
        }
        else{
            $_SESSION["date"] = date("Y-m-d");
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
        <style>
            .remove-row{
                display: <?php
                        if(isset($_SESSION["showRemove"])){
                            if($_SESSION["showRemove"] == TRUE){
                                echo "block";
                            }
                            else{
                                echo "none";
                            }
                        }
                        else{
                            echo "none";
                        }
                    ?>;
            }
        </style>
    </head>
    <body>
        <a href="indexadmin.php">Home</a>

        <br>

        <button onclick="showAdd()">ADD</button>
        <form method="get">
            <input type="hidden" name="date" value="<?php echo $_SESSION["date"]?>">
            <button id="remover" name="removeButton" value="assignment">REMOVE</button>
        </form>
        <form method="post">
            <button id="editor" name="editButton" value="assignment">EDIT</button>
        </form>
        <button onclick="showAddStaffIndie()">Add Staff</button>
        <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Assignment...">

        <br>

        <form method="get">
            <input type="date" name="date" value="<?php echo $_SESSION["date"]?>">
            <input type="submit" value="Filter" name="filterAttendance">
        </form>

        <?php
            include "addattendance.php";
            include "addindividual.php";
            include "remove.php";
            include "editassignment.php";
            include "filterattendance.php";
            include "navadmin.php";
        ?>
    </body>
    <script src="filtertable.js"></script>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editButton"])){
        $pageName = $_POST["editButton"];
        if($_SESSION["showEdit"] == FALSE){
            $_SESSION["showEdit"] = TRUE;
        }
        else{
            $_SESSION["showEdit"] = FALSE;
        }
        header("Location:$pageName.php");
        exit();
    }
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["removeButton"])){
        $pageName = $_GET["removeButton"].".php";
        if(isset($_SESSION["date"]) && $_SESSION["date"] != date("Y-m-d")){
            $pageName .= "?date=".$_SESSION["date"]."&filterAttendance=Filter";
        }

        if($_SESSION["showRemove"] == FALSE){
            $_SESSION["showRemove"] = TRUE;
        }
        else{
            $_SESSION["showRemove"] = FALSE;
        }
        header("Location:$pageName");
        exit();
    }
?>