<?php


$host = "localhost";
$user = "root";
$pass = "";
$db = "januareapp";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error){
    echo "Connection Failed";
    die;
}
 ?>