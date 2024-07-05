<?php
    session_start();
    if(isset($_SESSION["loggedin"]) == TRUE){
        header("Location: indexadmin.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <form method="post">
            ACCOUNT ID: <input type="text" name="accountID" required>
            PASSWORD: <input type="password" name="password">
            <input type="submit" value="Sign in" name="signin">
        </form>
    </body>
</html>

<?php
    if(isset($_POST["signin"])){
        $accountID = $_POST["accountID"];
        $pass = $_POST["password"];
        $conn = mysqli_connect("localhost","root","","mamaflors");
        if(!$conn->connect_error){
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
                        account.account_ID = '$accountID'
                    ";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row) > 0 && password_verify($pass, $row[0]["password"])){
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
                    //check for Role in account
                    header("Location: indexadmin.php");
                    
                    exit();
                }
            }
        }
        $conn->close();
    }
?>