
<?php
require 'Helper/Session.php';
CheckUser();
require_once 'Helper/Dbconnection.php';
$identifier = $_POST["identifier"];
$typeid = $_POST["typeid"];
$title = $_POST["title"];
$content=$_POST["content"];

$sql ="update x2_blog set title = '".$title."',content='".addslashes($content)."' where identifier = ".$identifier;
$conn->query ( "SET NAMES utf8" );
$conn->query($sql);

$result1 = $conn->query("Select *  from x2_blog where identifier = ".$identifier);
if ($result1->num_rows > 0) {
	while($row = $result1->fetch_assoc()) {
		echo $row["UpdateTime"];
	$ctime = $row["UpdateTime"];
	}
}
$filepath = "";
switch ($typeid) {
	case "1" :
		$filepath = "Technology/" . date('Y',strtotime($ctime)) . "/" .date('m',strtotime($ctime)) . "/" . date('d',strtotime($ctime)) . "/"  ;
		$blogcontent = "<div class=\"c_title\"><a href=\"/Technology/".date('YmdHis',strtotime($ctime)).".html\">".$title."</a></div>".$content;
		break;
	case "2" :
		$filepath = "Life/" . date('Y',strtotime($ctime)) . "/" .date('m',strtotime($ctime)) . "/" . date('d',strtotime($ctime)) . "/"  ;
		$blogcontent = "<div class=\"c_title\"><a href=\"/Life/".date('YmdHis',strtotime($ctime)).".html\">".$title."</a></div>".$content;
		
		break;
	case "3" :
		$filepath = "Novel/" . date('Y',strtotime($ctime)) . "/" .date('m',strtotime($ctime)) . "/" . date('d',strtotime($ctime)) . "/"  ;
		$blogcontent = "<div class=\"c_title\"><a href=\"/Novel/".date('YmdHis',strtotime($ctime)).".html\">".$title."</a></div>".$content;
		break;
}
if (!file_exists($filepath)) {mkdirs($filepath); };

if(file_put_contents($filepath.date('His',strtotime($ctime)).".html", $blogcontent))
{
	echo  '保存成功！';
}
else 
{
	echo '保存失败！';
}
function mkdirs($dir){
	return is_dir($dir) or (mkdirs(dirname($dir)) and (mkdir($dir) and chmod($dir, 0777)));
}


?>
