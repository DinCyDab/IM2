<?php
    ob_start();
    session_start();
    if(isset($_SESSION["loggedin"])){
        if($_SESSION["role"] != "Administrator"){
            header("Location: indexstaff.php");
            exit();
        }
        if($_SESSION["role"] == "Administrator"){
            header("Location: indexadmin.php");
            exit();
        }
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
                        *
                    FROM
                        account
                    WHERE
                        account_ID = '$accountID'
            ";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if(sizeof($row) > 0 && password_verify($pass, $row[0]["password"])){
                $_SESSION["account_ID"] = $row[0]["account_ID"];
                header("Location: authentication.php");
                exit();
            }
        }
        $conn->close();
    }
?>