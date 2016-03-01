<?php
function connection()
{
    $servername = "localhost";
    $username = "kelaniim_sa";
    $password = "paqqw0rd123";
    $database = "kelaniim_db";

// Create connection
    $conn = new mysqli($servername, $username, $password,$database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //mysqli_select_db($database) or die("Databse not found".mysqli_error());
    return $conn;
}

function getData($query){
    $result = mysqli_query(connection(),$query);
    return $result;
}
function connection_close(){
    mysqli_close(connection());
}
?>