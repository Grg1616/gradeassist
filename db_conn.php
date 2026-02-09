<?php

$sname= "localhost";
$unmae= "root"; 
// u457140180_garbagego    
$password ="";
// Garbagego2023
$db_name = "grade_assist";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

// For Localhost

if (!$conn) {
	echo "Connection failed!";
}
// For Hostiger Server

// if (!$conn) {
//     echo "Connection failed!";
// } else {
//     mysqli_query($conn, "SET time_zone = '+08:00'");
// }

?>