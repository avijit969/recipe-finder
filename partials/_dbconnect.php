<?php
$servername="localhost:3306";
$username="gtqmkycv_avi";
$password="avi@1142";
$database="gtqmkycv_recipe";

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn)
{
    die("connection is not successfull".mysqli_connect_errno());
}
else {
    // echo "Connection successfull<br>";
}

?>