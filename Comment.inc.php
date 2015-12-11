<?php
require_once 'Helper/Dbconnection.php';
$BlogId = $_POST["BlogId"];
$ComName = $_POST["ComName"];
$Email=$_POST["Email"];
$Comment=$_POST["Comment"];
$time = date('Y-m-d H:i:s');
$sql = "insert into Comment(BlogId,ComTime,ComName,Email,Comment) values('".$BlogId."','".$time."','".$ComName."','".$Email."','".$Comment."')";
$conn->query ( "SET NAMES utf8" );
echo $conn->query($sql);

?>