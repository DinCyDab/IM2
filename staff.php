<?php
    ob_start();
    session_start();
    if($_SESSION["role"] == "Regular") {
        header("Location: indexstaff.php");
        exit();
    }
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
        <link rel="stylesheet" href="scrollbarstyles.css">
        <link rel="stylesheet" href="styles.css">
        <style>
            body{
                display: block;
            }
            .edit-row{
                display: <?php
                        if(isset($_SESSION["showEdit"])){
                            if($_SESSION["showEdit"] == TRUE){
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
            .addstaffholder{
                display: none;
                width: 100%;
                height: 100vh;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, .5);
                padding: 15px;
                position: fixed;
                z-index: 2;
            }
            .add-staff{
                position: relative;
                background-color: wheat;
                width: fit-content;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                border: none;
                border-radius: 20px;
                box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.50);
            }
            .add-staff div{
                border: 1px black solid;
                padding: 15px;
            }
            .add-staff h4{
                margin: 0;
            }
            .add-staff-form div{
                display: flex;
            }
            .editstaffholder{
                display: block;
                width: 100%;
                height: 100vh;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, .5);
                padding: 15px;
                position: fixed;
                z-index: 2;
            }
            .edit-staff{
                position: relative;
                background-color: wheat;
                width: fit-content;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                border: none;
                border-radius: 20px;
                box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.50);
            }
            .edit-staff div{
                border: 1px black solid;
                padding: 15px;
            }
            .edit-staff h4{
                margin: 0;
            }
            .edit-staff-form div{
                display: flex;
            }
            .functionalitybuttons{
                /* border: 1px black solid; */
                top: 100px;
                display: flex;
                /* width: fit-content; */
                justify-content: center;
                align-items: center;
                padding: 10px;
                position: fixed;
                left: 50%;
                transform: translate(-50%, 0);
            }
            .functionalitybuttons button{
                padding: 10px;
                margin-left: 10px;
                margin-right: 10px;
                border-radius: 10px;
                background-color: white;
            }
            .functionalitybuttons input{
                padding: 10px;
                margin-left: 10px;
                margin-right: 10px;
                border-radius: 10px;
            }
            table{
                display: flex;
                position: relative;
                align-items: center;
                justify-content: center;
                margin-top: 120px;
                width: fit-content;
                top: 40px;
            }
            table th{
                background-color: sandybrown;
            }
            table a{
                color: brown;
            }
            table tr{
                background-color: brown;
                color: wheat;
                text-align: center
            }
            table tr:nth-child(even){
                background-color: wheat;
                color: brown;
            }
            .pageheader{
                position: relative;
                /* border: 1px black solid; */
                top: 140px;
                left: 50%;
                transform: translate(-50%, 0);
                z-index: -1;
            }
            .pageheader h1{
                color: wheat;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="functionalitybuttons">
            <button onclick="showAdd()">ADD</button>
            <form method="post">
                <button id="remover" name="removeButton" value="staff">REMOVE</button>
            </form>
            <?php 
                if($_SESSION["role"] == "Owner"){
                    echo '
                        <form method="post">
                            <button id="editor" name="editButton" value="staff">EDIT</button>
                        </form>
                    ';
                }
            ?>
            <input onkeyup="filterTable()" id="search" type="text" placeholder="Search Staff...">
        </div>
        <div class="pageheader">
            <h1>Staffs</h1>
        </div>

        <?php
            include "addstaff.php";
            include "editstaff.php";
            include "remove.php";
            include "navadmin.php";
        ?>
        <?php 
            //Connect to db
            $conn = mysqli_connect("localhost","root","","mamaflors");
            if ($conn->connect_error) {
                die("ERROR". $conn->connect_error);
            }
            else{
                //Retrieve Data from staff table
                $sql = "SELECT * FROM staff";
                if(isset($_GET["sort"])){
                    if($_SESSION["SORT"] == "DESC"){
                        $_SESSION["SORT"] = "ASC";
                    }
                    else{
                        $_SESSION["SORT"] = "DESC";
                    }
                    $sql .= " ORDER BY " . $_GET["sort"] . " " . $_SESSION["SORT"];
                }
                $result = $conn->query($sql);
                $row = $result->fetch_all(MYSQLI_ASSOC);
                if(sizeof($row) > 0){
                    echo "
                        <table id='table'>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><a href='?sort=staff_ID'>Staff ID</a></th>
                                <th><a href='?sort=last_name'>Last Name</a></th>
                                <th><a href='?sort=first_name'>First Name</a></th>
                                <th><a href='?sort=middle_name'>Middle Name</a></th>
                                <th><a href='?sort=house_number'>House Number</a></th>
                                <th><a href='?sort=street_name'>Street Name</a></th>
                                <th><a href='?sort=barangay'>Barangay</a></th>
                                <th><a href='?sort=city'>City</a></th>
                                <th><a href='?sort=province'>Province</a></th>
                                <th><a href='?sort=postal_code'>Postal Code</a></th>
                                <th><a href='?sort=birth_date'>Birthdate</a></th>
                                <th><a href='?sort=gender'>Gender</a></th>
                                <th><a href='?sort=contact_1'>Contact Number(1)</a></th>
                                <th><a href='?sort=contact_2'>Contact Number(2)</a></th>
                                <th><a href='?sort=email'>Email</a></th>
                                <th><a href='?sort=SSN'>SSN</a></th>
                                <th><a href='?sort=TIN'>TIN</a></th>
                                <th><a href='?sort=position_title'>Position Title</a></th>
                                <th><a href='?sort=start_date'>Start Date</a></th>
                                <th><a href='?sort=salary'>Salary</a></th>
                                <th><a href='?sort=status'>Status</a></th>
                            </tr>
                        ";
                    for($x = 0; $x < sizeof($row); $x++){
                        echo "
                            <tr>
                                <td>
                                    ";
                                if($_SESSION["role"] == "Owner"){
                                    echo "
                                    <form method='get'>
                                        <input type='hidden' value='".($row[$x]['staff_ID'])."' name='edit'>
                                        <button class='edit-row' id='edit-row$x' type='submit'>EDIT</button>
                                    </form>";
                                }
                        echo "
                                </td>
                                <td>
                                    <form method='get'>
                                        <input type='hidden' value='".($row[$x]['staff_ID'])."' name='removeID'>
                                        <input type='hidden' value='staff' name='tableName'>
                                        <input type='hidden' value='staff_ID' name='columnName'>
                                        <button class='remove-row' id='remove-row$x' name='remove'>Remove</button>
                                    </form>
                                </td>
                                <td>".$row[$x]['staff_ID']."</td>
                                <td>".$row[$x]['last_name']."</td>
                                <td>".$row[$x]['first_name']."</td>
                                <td>".$row[$x]['middle_name']."</td>
                                <td>".$row[$x]['house_number']."</td>
                                <td>".$row[$x]['street_name']."</td>
                                <td>".$row[$x]['barangay']."</td>
                                <td>".$row[$x]['city']."</td>
                                <td>".$row[$x]['province']."</td>
                                <td>".$row[$x]['postal_code']."</td>
                                <td>".$row[$x]['birth_date']."</th>
                                <td>".$row[$x]['gender']."</td>
                                <td>".$row[$x]['contact_1']."</td>
                                <td>".$row[$x]['contact_2']."</td>
                                <td>".$row[$x]['email']."</td>
                                <td>".$row[$x]['SSN']."</td>
                                <td>".$row[$x]['TIN']."</td>
                                <td>".$row[$x]['position_title']."</td>
                                <td>".$row[$x]['start_date']."</td>
                                <td>".$row[$x]['salary']."</td>
                                <td>".$row[$x]['status']."</td>
                            </tr>
                        ";
                    }
                    echo "</table>";
                }
                else{
                    echo "Database is Empty";
                }
            }
            $conn->close();
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