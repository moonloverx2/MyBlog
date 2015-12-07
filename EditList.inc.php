<?php

require 'Helper/Session.php';
CheckUser();

require 'Helper/Dbconnection.php';
$identifier = $_POST["identifier"];
$time = $_POST["updatetime"];
$type = $_POST["type"];
$htmlpath = $type."/".date('Y',strtotime($time))."/".date('m',strtotime($time))."/".date('d',strtotime($time))."/".date('His',strtotime($time)).".html";
$sql = "delete from x2_blog where identifier = ".$identifier."";
$result = $conn->query($sql);
unlink($htmlpath);
echo $result;


?>