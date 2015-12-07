<meta charset="UTF-8">
<?php
include 'DBComFunction/Connection.php';
session_start ();
$UserName = $_POST ["author"];
$PassWord = $_POST ["password"];
$isrem = $_POST ["isrem"];


if(md5($UserName)=="8e683187a00e5d462a4aeee69e9d3d9c"&&md5($PassWord)=="706d16776049525ff4ce5b637e6ac0fa")
{
	$_SESSION['Identifier'] = $UserName;
   if ($isrem != null) {
	 setcookie ( "Identifier", $UserName, time () + 2 * 7 * 24 * 3600 );
    }
    header("Location: EditList.php");
}
else
{
	echo "用户名或密码错误。<a href='Login.php'>登录</a>";
}

?>