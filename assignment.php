<!DOCTYPE html>
<html>
    <head>
        <style>
            .add-attendance{
                display: none;
            }
            .remove-row{
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
            #editor{
                display: none;
            }
        </style>
    </head>
    <body>
        <a href="index.php">Home</a>

        <br>

        <button onclick="showAdd()">ADD</button>
        <button id="remover">REMOVE</button>
        <button id="editor">EDIT</button>
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
    <script src="filtertable.js"></script>
</html>

