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
        <style>
            body{
                display: block;
            }
            .scheduleHeader{
                position: relative;
                /* border: 1px white solid; */
                top: 75px;
            }
            .scheduleHeader h1{
                text-align: center;
                color: whitesmoke;
                font-family: cursive;
            }
            .addressinfo div{
                display: flex;
            }
            /* .addressinfo input{
                width: 20px;
            } */
            form input{
                min-width: 20px;
                max-width: 90px;
                background-color: sandybrown;
                padding: 10px;
                border: none;
                border-radius: 20px;
            }
            form input[readonly]{
                border-radius: 20px;
                background-color: inherit;
                border: none;
            }
        </style>
    </head>

    <body>
        <?php
        include "navstaff.php";
        ?>
        <div class="scheduleHeader">
            <h1>Account Settings</h1>
        </div>
        <form method="post">
            <div id="accID" style="background-color: sandybrown">
                <h2>Account ID:</h2>
                <input type="text" value="<?php echo $_SESSION["account_ID"] ?>" readonly>
            </div>
            <div class="flex" style="display:block">
                <h4>Full Name:</h4>
                <div style="display:flex">
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
            </div>
            <div class="flex" style="display:block">
                <div>
                    <h4>Address:</h4>
                </div>
                <div class="addressinfo" style="display:flex">
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
            </div>
            <div class="flex" style="display:block">
                <div>
                    <h4>Contact Information:</h4>
                </div>
                <div style="display: flex">
                    <div>
                        Contact 1: <input type="text" value="<?php echo $_SESSION["contact_1"] ?>" readonly>
                    </div>
                    <div>
                        Contact 2: <input type="text" value="<?php echo $_SESSION["contact_2"] ?>" readonly> </div>
                    <div>
                        Email: <input type="text" value="<?php echo $_SESSION["email"] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="flex pass" style="display: block">
                <div>
                    <h4>Password:</h4>
                </div>
                <div style="display:flex">
                    <div>
                        Enter Old Password: <input type="password" name="oldpassword">
                    </div>
                    <div>
                        Enter New Password: <input type="password" name="newpassword">
                    </div>
                    <div>
                        Confirm Password: <input type="password" name="confirmpassword">
                    </div>
                </div>
            </div>
            <div style="padding: 40px">
                <input style="position: relative;
                            left: 50%;
                            transform: translate(-50%, 0);"
                            type="submit" value="Update" name="Update" class="update">
            </div>
        </form>
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