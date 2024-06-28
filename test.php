<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <a href="index.php">Home</a>
        <?php 
            //retrieve some data first
            $conn = mysqli_connect("localhost","root","","mamaflors");
            if($conn->connect_error){
                die("ERROR". $conn->connect_error);
            }
            else{
                $sql = "SELECT product_ID, product_name, product_status FROM product";
                $result = $conn->query($sql);
                $row = $result->fetch_all(MYSQLI_ASSOC);
                if(sizeof($row) > 0){
                    echo '<select>';
                        for($x = 0; $x < sizeof($row); $x++){
                            if($row[$x]["product_status"] != "Inactive"){
                                echo '<option value="'.$row[$x]["product_ID"].'">'.$row[$x]["product_ID"].' '.$row[$x]["product_name"].'</option>';
                            }
                        }
                    echo '</select>';
                }
            }
            $conn->close();
        ?>
    </body>
</html>