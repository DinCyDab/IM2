<?php
    ob_start();
    session_start();
    if(!isset($_SESSION["session_started"])){
        $_SESSION["session_started"] = TRUE;
        $_SESSION["showEdit"] = FALSE;
        $_SESSION["showRemove"] = FALSE;
    }
    if(!isset($_SESSION["SORT"])){
        $_SESSION["SORT"] = "DESC";
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
        <a href="index.php">Home</a>

        <br>

        <button onclick="showAdd()">ADD</button>
        <form method="post">
            <button id="remover" name="removeButton" value="assignment">REMOVE</button>
        </form>
        <form method="post">
            <button id="editor" name="editButton" value="assignment">EDIT</button>
        </form>
        <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Assignment...">
        
        <br>

        <form method="get">
            <select name="year">
                <option value="2024">2024</option>
            </select>
            <select name="month">
                <?php
                    if(isset($_GET["month"])){
                        $default = $_GET["month"];
                    }
                    else{
                        $default = date("n");
                    }
                    for($x = 1; $x <= 12; $x++){
                        if($x == $default){
                            $selected = 'selected';
                        }
                        else{
                            $selected = '';
                        }
                        echo "<option value='$x' $selected>".date('F', mktime(0, 0, 0, $x))."</option>";
                    }
                ?>
            </select>
            <select name="day">
                <?php
                    if(isset($_GET["day"])){
                        $default_day = $_GET["day"];
                    }
                    else{
                        $default_day = date("d");
                    }

                    for($x = 1; $x <= 31; $x++){
                        if ($x == $default_day) {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }
                        echo "<option value='$x' $selected>$x</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Filter" name="filterAttendance">
        </form>

        <?php
            include "addattendance.php";
            include "remove.php";
            include "editassignment.php";
            include "filterattendance.php";
        ?>
    </body>
    <?php
        include "filtertable.php";
    ?>
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
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["removeButton"])){
        $pageName = $_POST["removeButton"];
        if($_SESSION["showRemove"] == FALSE){
            $_SESSION["showRemove"] = TRUE;
        }
        else{
            $_SESSION["showRemove"] = FALSE;
        }
        header("Location:$pageName.php");
        exit();
    }
?>