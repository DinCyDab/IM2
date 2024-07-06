<!-- No need front end design in here -->
<?php
    ob_start();
    session_start();
    $conn = mysqli_connect("localhost","root","","mamaflors");
    $sql = "SELECT
        account.*,
        assignment.*,
        branch.*,
        staff.*
    FROM
        ((account
        INNER JOIN assignment ON assignment.staff_ID = account.account_ID)
        LEFT JOIN branch ON assignment.branch_ID = branch.branch_ID)
        LEFT JOIN staff ON account.account_ID = staff.staff_ID
    WHERE
        account.account_ID = '".$_SESSION["account_ID"]."'
        AND
        assignment.assignment_date = CURRENT_DATE
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_all(MYSQLI_ASSOC);
    if(sizeof($row) > 0){
        if($row[0]["account_status"] == 'Active'){
            $_SESSION["loggedin"] = TRUE;
            $_SESSION["branch_assigned"] = $row[0]["branch_name"];
            $_SESSION["branch_ID"] = $row[0]["branch_ID"];
            $_SESSION["account_ID"] = $row[0]["account_ID"];
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
            //check for Role in account
            if($_SESSION["role"] == "Administrator"){
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