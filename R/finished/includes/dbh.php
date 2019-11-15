<?php
$servername="localhost";
$dbusername="root";
$dbpassword="";
$dbname="hospital";
$conn=mysqli_connect($servername,$dbusername,$dbpassword,$dbname);
if(!$conn){
    die("connection failed");
}
