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
        <!-- <link rel="stylesheet" href="editprofile.css"> -->
        <link rel="stylesheet" href="scrollbarstyles.css">
        <style>
            body{
                display: block;
            }
            .accountsettingsheader{
                position: relative;
                /* border: 1px white solid; */
                top: 75px;
            }
            .accountsettingsheader h1{
                text-align: center;
                color: whitesmoke;
                font-family: cursive;
            }
            /* .addressinfo div{
                display: flex;
            }
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
            } */
            .accountsettingsholder{
                width: min-content;
                position: relative;
                background-color: wheat;
                top: 70px;
                left: 50%;
                transform: translate(-50%, 0%);
                border-radius: 20px;
            }
            .account-settings-form{
                padding: 30px;
            }
            .account-settings-form div{
                /* border: 1px black solid; */
                padding: 5px;
                position: relative;
                align-items: center;
                justify-content: center;
            }
            .account-settings-form h4{
                margin: 0;
            }
            .form-header{
                background-color: sandybrown;
                display: flex;
                position: relative;
                align-items: center;
                justify-content: center;
            }
            .form-header input{
                background-color: sandybrown;
                border: none;
                width: 30px;
            }
            .form-body input{
                background-color: inherit;
                border: none;
            }
            /* .submitbutton{
                border: 1px black solid;
            } */
            .submitbutton input{
                position: relative;
                left: 50%;
                transform: translate(-50%, 0%);
                padding: 10px;
                border-radius: 10px;
            }
            .form-content div{
                border: 1px black solid;
                border-radius: 10px;
                margin-right: 10px;
                margin: 5px;
                box-shadow: 0px 0px 10px 0px;
            }
            .form-content h4{
                color: brown;
            }
        </style>
    </head>

    <body>
        <?php
            if($_SESSION["role"] == "Administrator" || $_SESSION["role"] == "Owner"){
                include "navadmin.php";
            }
            else{
                include "navstaff.php";
            }
        ?>
        <div class="accountsettingsheader">
            <h1>Account Settings</h1>
        </div>
        <div class="accountsettingsholder">
            <form name="passForm" method="post" class="account-settings-form" onsubmit="return validateForm()" id="passForm">
                <div class="form-header">
                    <h4>Account ID:</h4>
                    <input type="text" value="<?php echo $_SESSION["account_ID"] ?>" readonly>
                </div>
                <div class="form-body" style="display:block">
                    <h4>Full Name:</h4>
                    <div class="form-content" style="display:flex">
                        <div>
                            <h4>Last Name:</h4> <input type="text" value="<?php echo $_SESSION["last_name"] ?>" readonly>
                        </div>
                        <div>
                            <h4>First Name:</h4> <input type="text" value="<?php echo $_SESSION["first_name"] ?>" readonly>
                        </div>
                        <div>
                            <h4>Middle Name:</h4> <input type="text" value="<?php echo $_SESSION["middle_name"] ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-body" style="display:block">
                    <div>
                        <h4>Address:</h4>
                    </div>
                    <div style="display:flex">
                        <div class="form-content">
                            <div>
                                <h4>House Number:</h4> <input type="text" value="<?php echo $_SESSION["house_number"] ?>" readonly>
                            </div>
                            <div>
                                <h4>Street Name:</h4> <input type="text" value="<?php echo $_SESSION["street_name"] ?>" readonly>
                            </div>
                            <div>
                                <h4>Barangay:</h4> <input type="text" value="<?php echo $_SESSION["barangay"] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-content">
                            <div>
                                <h4>City:</h4> <input type="text" value="<?php echo $_SESSION["city"] ?>" readonly>
                            </div>
                            <div>
                                <h4>Province:</h4> <input type="text" value="<?php echo $_SESSION["province"] ?>" readonly>
                            </div>
                            <div>
                                <h4>Postal Code:</h4><input type="text" value="<?php echo $_SESSION["postal_code"] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-body" style="display:block">
                    <div>
                        <h4>Contact Information:</h4>
                    </div>
                    <div  class="form-content" style="display: flex">
                        <div>
                            <h4>Contact 1:</h4> <input type="text" value="<?php echo $_SESSION["contact_1"] ?>" readonly>
                        </div>
                        <div>
                            <h4>Contact 2:</h4> <input type="text" value="<?php echo $_SESSION["contact_2"] ?>" readonly> </div>
                        <div>
                            <h4>Email:</h4> <input type="text" value="<?php echo $_SESSION["email"] ?>" readonly>
                        </div>
                    </div>
                </div>
                <div style="display: block">
                    <div>
                        <h4>Password:</h4>
                    </div>
                    <div class="form-content" style="display:flex">
                        <div>
                            <h4>Enter Old Password:</h4> <input type="password" name="oldpassword">
                        </div>
                        <div>
                            <h4>Enter New Password:</h4> <input type="password" name="newpassword">
                        </div>
                        <div>
                            <h4>Confirm Password:</h4> <input type="password" name="confirmpassword">
                        </div>
                    </div>
                </div>
                <div class="submitbutton">
                    <input type="submit" value="Update Password" name="Update" class="update">
                </div>
            </form>
        </div>
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
        header("Location: ".$_SERVER["PHP_SELF"]);
        exit();
    }
}
?>

<?php 
    include "errorfolder/error.php";
    include "confirmationfolder/confirmationpass.php";
?>

<script>
    function validateForm(){
        var newpassword = document.forms["passForm"]["newpassword"].value;
        var confirmpassword = document.forms["passForm"]["confirmpassword"].value;
        if(newpassword != confirmpassword){
            document.getElementById("errorMsg").style.display = "block";
            return false;
        }
        else{
            document.getElementById("confirmationpass").style.display = "block";
        }
        return false;
    }
</script>