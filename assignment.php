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
        <style>
            .add-attendance{
                display: none;
            }
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
            table{
                border-collapse: collapse;
            }
            th, tr{
                border: 1px aqua solid;
            }
            tr:nth-child(even){
                background-color: aqua;
            }
            #editor{
                display: none;
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
        <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Assignment...">
        
        <br>

        <form method="get">
            <input type="date" name="date" value="<?php echo $_SESSION["date"]?>">
            <input type="submit" value="Filter" name="filterAttendance">
        </form>

        <?php
            include "addattendance.php";
            include "remove.php";
            include "editassignment.php";
            include "filterattendance.php";
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