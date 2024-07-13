<?php
    require_once 'utils.php';
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
        <title>Mama Flor's Lechon House</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <div class="grid-40-60">
            <div>
                <img src="imagesources/logo.png" alt="Mamaflors Logo">
            </div>
            <div>
                <form method="post" class="signin">
                    <span>Sign in</span>
                    <input type="text" id="accountID" name="accountID" placeholder="Account ID" required>
                    <input type="password" id="password" name="password" placeholder="Password">
                    <button name="signin">Sign in</button>
                </form>
            </div>
        </div>
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
                $_SESSION["pass"] = $pass;
                header("Location: authentication.php");
                exit();
            }
        }
        $conn->close();
    }
?>