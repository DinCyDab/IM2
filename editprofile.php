<?php
ob_start();
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="editprofile.css">
    </head>

    <body>
        <?php
        include "navstaff.php";
        ?>
        <form method="post">
            <div id="accID">
                Account ID: <input type="text" value="<?php echo $_SESSION["account_ID"] ?>" readonly>
            </div>
            <div class="flex">
                Full Name:
                <div>
                    Last Name: <input type="text" value="<?php echo $_SESSION["last_name"] ?>" readonly>
                </div>
                <div>
                    First Name: <input type="text" value="<?php echo $_SESSION["first_name"] ?>" readonly>
                </div>
                <div>
                    Middle Name: <input type="text" value="<?php echo $_SESSION["middle_name"] ?>" readonly>
                </div>
            </div>
            <div class="flex">
                Address
                <div>
                    House Number: <input type="text" value="<?php echo $_SESSION["house_number"] ?>" readonly>
                </div>
                <div>
                    Street Name: <input type="text" value="<?php echo $_SESSION["street_name"] ?>" readonly>
                </div>
                <div>
                    Barangay: <input type="text" value="<?php echo $_SESSION["barangay"] ?>" readonly>
                </div>
                <div>
                    City: <input type="text" value="<?php echo $_SESSION["city"] ?>" readonly>
                </div>
                <div>
                    Province: <input type="text" value="<?php echo $_SESSION["province"] ?>" readonly>
                </div>
                <div>
                    Postal Code:<input type="text" value="<?php echo $_SESSION["postal_code"] ?>" readonly>
                </div>
            </div>
            <div class="flex">
                <div>
                    Contact 1: <input type="text" value="<?php echo $_SESSION["contact_1"] ?>" readonly>
                </div>
                <div>
                    Contact 2: <input type="text" value="<?php echo $_SESSION["contact_2"] ?>" readonly> </div>
                <div>
                    Email: <input type="text" value="<?php echo $_SESSION["email"] ?>" readonly>
                </div>
            </div>
            <div class="flex pass">
                Password:
                <div>
                    Enter Old Password: <input type="text" name="oldpassword">
                </div>
                <div>
                    Enter New Password: <input type="text" name="newpassword">
                </div>
                <div>
                    Confirm Password: <input type="text" name="confirmpassword">
                </div>
            </div>
            <input type="submit" value="Update" name="Update" class="update">
        </form>

        <button class="back">
            <a href="indexstaff.php">Back</a>
        </button>
    </body>

</html>

<?php
if (isset($_POST["Update"])) {
    $newpass = $_POST["newpassword"];
    $confirmpass = $_POST["confirmpassword"];
    if ($newpass == $confirmpass) {
        $newpass = password_hash("$newpass", PASSWORD_DEFAULT);
        $oldpass = $_POST["oldpassword"];
        $conn = mysqli_connect("localhost", "root", "", "mamaflors");
        if (!$conn->connect_error) {
            $sql = "SELECT
                            password
                        FROM
                            account
                        WHERE
                            account_ID = ".$_SESSION['account_ID']."
                ";
            $result = $conn->query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if (password_verify($oldpass, $row[0]["password"])) {
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