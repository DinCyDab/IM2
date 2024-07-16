<?php
function setDefaultDate()
{
    if (!isset($_GET["filterDate"])) {
        $_SESSION["currDate"] = date("Y-m-d");
    } else {
        $_SESSION["currDate"] = $_GET["currDate"];
    }

    //Make Filter Date Default
    if (!isset($_GET["filterDate"])) {
        $_SESSION["filterDateBy"] = 0;
    } else {
        $_SESSION["filterDateBy"] = $_GET["filterDateBy"];
    }
}


function redirectIfLoggedIn()
{
    if (isset($_SESSION["loggedin"])) {
        if ($_SESSION["role"] != "Administrator") {
            header("Location: staff.php");
            exit();
        }
        if ($_SESSION["role"] == "Administrator" || $_SESSION["role"] == "Owner") {
            header("Location: admin.php");
            exit();
        }
    }
}

function redirectIfRegularUser()
{
    if ($_SESSION["role"] == "Regular") {
        header("Location: staff.php");
    }
}

function redirectIfNotLoggedIn()
{
    if (!isset($_SESSION["loggedin"])) {
        header("Location: index.php");
        exit();
    }
}

function logout()
{
    ob_start();
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

function authenticate()
{
    ob_start();
    session_start();
    date_default_timezone_set('Asia/Manila');
    $conn = mysqli_connect("localhost", "root", "", "mamaflors");
    $sql = "SELECT
        account.*,
        staff.*
    FROM
        account
        INNER JOIN staff ON account.account_ID = staff.staff_ID
    WHERE
        account.account_ID = '" . $_SESSION["account_ID"] . "'
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_all(MYSQLI_ASSOC);
    if (sizeof($row) > 0 && password_verify($_SESSION["pass"], $row[0]["password"])) {
        if ($row[0]["account_status"] == 'Active') {
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
                    account.account_ID = " . $_SESSION["account_ID"] . "
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
            if (isset($_SESSION["branch_ID"])) {
                $status = "Present";
                $time_in = "CURRENT_TIME";
                if ($current_time > '08:00:00') {
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
                    staff_ID = '" . $_SESSION["account_ID"] . "'
                    AND
                    time_in IS NULL
                    AND
                    assignment_date = CURRENT_DATE
            ";
            $conn->query($sql);

            if ($_SESSION["role"] == "Administrator" || $_SESSION["role"] == "Owner") {
                header("Location: admin.php");
            } else {
                header("Location: staff.php");
            }
            exit();
        }
    }
    $conn->close();
}

if (isset($_GET['logout'])) {
    logout();
}

if (isset($_GET['authenticate'])) {
    authenticate();
}

if (isset($_GET["remove"])) {
    $removeID = $_GET["remove"];
    $tableName = $_GET["tableName"];
    $columnName = $_GET["columnName"];
    $conn = mysqli_connect("localhost", "root", "", "mamaflors");
    if ($conn->connect_error) {
        die("ERROR" . $conn->connect_error);
    } else {
        try {
            $sql = "DELETE FROM $tableName
                WHERE $columnName = $removeID";
        $conn->query($sql);
        } catch (mysqli_sql_exception) {
            echo "<script>alert('Product is currently in use. Cannot delete it!')</script>";
        }
    }
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-product"])) {
    $productName = $_POST["product-name"];
    $productDesc = $_POST["product-description"];
    $productPrice = $_POST["product-price"];
    $productStatus = $_POST["product-status"];

    $conn = mysqli_connect("localhost", "root", "", "mamaflors");

    if ($conn->connect_error) {
        die("ERROR" . $conn->connect_error);
    } else {
        $sql = "INSERT INTO product(product_name, product_description, product_price, product_status)
                VALUES('$productName', '$productDesc', $productPrice, '$productStatus')";
        $conn->query($sql);
    }
    $conn->close();
    header("Location: product.php");
    exit();
}

if (isset($_GET["edit"])) {
    $productid = $_GET["edit"];
    $conn = mysqli_connect("localhost", "root", "", "mamaflors");
    if ($conn->connect_error) {
        die("ERROR" . $conn->connect_error);
    } else {
        $sql = "SELECT * FROM product
                WHERE product_ID = $productid";
        $result = $conn->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if (sizeof($row) > 0) {
            echo '
                <div class="modal-container show" id="edit-modal">
                    <div class="modal">
                        <h1>Edit Product</h1>
                        <button class="modal-close-button" onclick="closeEditModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                            </svg>
                        </button>
                        <form method="POST">
                            <div>
                                <label>Product Name</label>
                                <input type="text" name="product-name" value="' . $row[0]["product_name"] . '" required>
                            </div>
                            <div>
                                <label>Product Description</label>
                                <input type="text" name="product-description" value="' . $row[0]["product_description"] . '">
                            </div>
                            <div>
                                <label>Product Price</label>
                                <input type="number" name="product-price" min="0" max="9999999999" value="' . $row[0]["product_price"] . '" required>
                            </div>
                            <div>
                                <label>Product Status</label>
                                <select name="product-status" value="' . $row[0]["product_status"] . '">
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                            <input type="submit" value="Submit" name="update-product">
                        </form>
                    </div>
                </div>
            ';
        } else {
            echo "No Product Listed";
        }
    }
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update-product"])) {
    $productname = $_POST["product-name"];
    $productdescription = $_POST["product-description"];
    $productprice = $_POST["product-price"];
    $productstatus = $_POST["product-status"];

    $conn = mysqli_connect("localhost", "root", "", "mamaflors");
    if ($conn->connect_error) {
        die("ERROR" . $conn->connect_error);
    } else {
        $sql = "UPDATE product
                    SET
                        product_name = '$productname',
                        product_description = '$productdescription',
                        product_price = '$productprice',
                        product_status = '$productstatus'
                    WHERE product_ID = $productid
                    ";
        $conn->query($sql);
    }
    $conn->close();
    $_SESSION["showEdit"] = TRUE;
    header("Location: product.php");
    exit();
}
