<?php
    ob_start();
    session_start();
    if(!isset($_SESSION["loggedin"])){
        header ("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php 
            include "navstaff.php";
        ?>
        <a href="indexstaff.php">Back</a>
        <form method="post">
            Account ID: <input type="text" value="<?php echo $_SESSION["account_ID"]?>" readonly>
            <br>
            Full Name:
            <br>
            Last Name: <input type="text" value="<?php echo $_SESSION["last_name"]?>" readonly>
            First Name: <input type="text" value="<?php echo $_SESSION["first_name"]?>" readonly>
            Middle Name: <input type="text" value="<?php echo $_SESSION["middle_name"]?>" readonly>
            <br>
            <br>
            Address
            <br>
            House Number: <input type="text" value="<?php echo $_SESSION["house_number"]?>" readonly>
            Street Name: <input type="text" value="<?php echo $_SESSION["street_name"]?>" readonly>
            Barangay: <input type="text" value="<?php echo $_SESSION["barangay"]?>" readonly>
            City: <input type="text" value="<?php echo $_SESSION["city"]?>" readonly>
            Province: <input type="text" value="<?php echo $_SESSION["province"]?>" readonly>
            Postal Code:<input type="text" value="<?php echo $_SESSION["postal_code"]?>" readonly>
            Contact 1: <input type="text" value="<?php echo $_SESSION["contact_1"]?>" readonly>
            Contact 2: <input type="text" value="<?php echo $_SESSION["contact_2"]?>" readonly>
            Email: <input type="text" value="<?php echo $_SESSION["email"]?>" readonly>
            <br>
            <br>
            Password:
            <br>
            Enter New Password: <input type="text" name="newpassword">
            Confirm Password: <input type="text" name="confirmpassword">
            Enter Old Password: <input type="text" name="oldpassword">
            <input type="submit" value="Update" name="Update">
        </form>
    </body>
</html>

<?php 
    if(isset($_POST["Update"])){
        $newpass = $_POST["newpassword"];
        $confirmpass = $_POST["confirmpassword"];
        if($newpass == $confirmpass){
            $newpass = password_hash("$newpass", PASSWORD_DEFAULT);
            $oldpass = $_POST["oldpassword"];
            $conn = mysqli_connect("localhost","root","","mamaflors");
            if(!$conn->connect_error){
                $sql = "SELECT
                            password
                        FROM
                            account
                        WHERE
                            account_ID = ".$_SESSION['account_ID']."
                ";
                $result = $conn->query($sql);
                $row = $result->fetch_all(MYSQLI_ASSOC);
                if(password_verify($oldpass, $row[0]["password"])){
                    $sql = "UPDATE
                                account
                            SET
                                password = '$newpass'
                            WHERE
                                account_ID = ".$_SESSION['account_ID']."
                    ";
                    $conn->query($sql);
                }
            }
            $conn->close();
            header("Location: indexstaff.php");
            exit();
        }
    }
?>