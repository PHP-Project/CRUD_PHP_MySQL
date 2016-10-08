<?php
    include_once("connection.php");
    if (isset($_GET['format']) && $_GET['format'] == "json"){
        $query = "SELECT * FROM tbl_post";
        $result = mysqli_query($conn,$query);
        $myArray = array();
        while($row = $result->fetch_array(MYSQL_ASSOC)){
            $myArray[] = $row;
        }
        echo json_encode($myArray);
        $result->close();
        exit;
    }

    echo "Add <i>?format=json</i> the end of URL ";
?>