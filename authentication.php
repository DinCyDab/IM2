<!-- No need front end design in here -->
<?php
    ob_start();
    session_start();
    date_default_timezone_set('Asia/Manila');
    $conn = mysqli_connect("localhost","root","","mamaflors");
    $sql = "SELECT
        account.*,
        staff.*
    FROM
        account
        INNER JOIN staff ON account.account_ID = staff.staff_ID
    WHERE
        account.account_ID = '".$_SESSION["account_ID"]."'
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_all(MYSQLI_ASSOC);
    if(sizeof($row) > 0 && password_verify($_SESSION["pass"], $row[0]["password"])){
        if($row[0]["account_status"] == 'Active'){
            $_SESSION["loggedin"] = TRUE;
            $_SESSION["last_name"] = $row[0]["last_name"];
            $_SESSION["first_name"] = $row[0]["first_name"];
            $_SESSION["middle_name"] = $row[0]["middle_name"];
            $_SESSION["house_number"] = $row[0]["house_number"];
            $_SESSION["street_name"] = $row[0]["street_name"];
            $_SESSION["barangay"] = $row[0]["barangay"];
            $_SESSION["city"] = $row[0]["city"];
            $_SESSION["province"] = $row[0]["province"];
            $_SESSION["postal_code"] = $row[0]["postal_code"];
            $_SESSION["contact_1"] = $row[0]["contact_1"];
            $_SESSION["contact_2"] = $row[0]["contact_2"];
            $_SESSION["email"] = $row[0]["email"];
            $_SESSION["role"] = $row[0]["role"];
            
            $sql = "SELECT
                    branch.branch_ID,
                    branch.branch_name,
                    account.account_ID
                FROM
                    (assignment
                    INNER JOIN branch ON assignment.branch_ID = branch.branch_ID)
                    INNER JOIN account ON assignment.staff_ID = account.account_ID
                WHERE
                    account.account_ID = ".$_SESSION["account_ID"]."
                    AND
                    assignment.assignment_date = CURRENT_DATE
            ";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            $_SESSION["branch_ID"] = $row[0]["branch_ID"];
            $_SESSION["branch_assigned"] = $row[0]["branch_name"];
            $current_time = date('H:i:s');
            $status = "Off";
            $time_in = 'NULL';
            if(isset($_SESSION["branch_ID"])){
                $status = "Present";
                $time_in = "CURRENT_TIME";
                if($current_time > '08:00:00'){
                    $status = "Late";
                }
            }

            $sql = "
                UPDATE
                    assignment
                SET
                    time_in = $time_in,
                    assignment_status = '$status'
                WHERE
                    staff_ID = '".$_SESSION["account_ID"]."'
                    AND
                    time_in IS NULL
                    AND
                    assignment_date = CURRENT_DATE
            ";
            $conn->query($sql);
            //check for Role in account
            if($_SESSION["role"] == "Administrator" || $_SESSION["role"] == "Owner"){
                header("Location: indexadmin.php");
            }
            else{
                header("Location: indexstaff.php");
            }
            exit();
        }
    }
    $conn->close();
?>