<?php
require_once 'Helper/Dbconnection.php';
$BlogId = $_POST["BlogId"];
$ComName = $_POST["ComName"];
$Email=$_POST["Email"];
$Comment=$_POST["Comment"];
$time = date('Y-m-d H:i:s');
$sql = "insert into Commet(BlogId,ComTime,ComName,Email,Commet) values('".$BlogId."','".$time."','".$ComName."','".$Email."','".$Comment."')";
echo $conn->query($sql);

?>