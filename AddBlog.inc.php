<?php
require_once 'Helper/Dbconnection.php';
$typeid = $_POST["typeid"];
$title = $_POST["title"];
$content=$_POST["content"];

$ctime = date('Y-m-d H:i:s');
$filepath = "";
switch ($typeid) {
	case "1" :
		$filepath = "Technology/" . date ( "Y" ) . "/" . date ( "m" ) . "/" . date ( "d" ) . "/"  ;
		$blogcontent = "<div class=\"c_title\"><a href=\"/Technology/".date('YmdHis',strtotime($ctime))."html\">".$title."</a></div>".$content;
		break;
	case "2" :
		$filepath = "Life/" . date ( "Y" ) . "/" . date ( "m" ) . "/" . date ( "d" ) . "/";
		$blogcontent = "<div class=\"c_title\"><a href=\"/Life/".date('YmdHis',strtotime($ctime)).".html\">".$title."</a></div>".$content;
		
		break;
	case "3" :
		$filepath = "Novel/" . date ( "Y" ) . "/" . date ( "m" ) . "/" . date ( "d" ) . "/";
		$blogcontent = "<div class=\"c_title\"><a href=\"/Novel/".date('YmdHis',strtotime($ctime)).".html\">".$title."</a></div>".$content;
		break;
}
if (!file_exists($filepath)) {mkdirs($filepath); };
if(file_put_contents($filepath.date('His',strtotime($ctime)).".html", $blogcontent))
{
	$sql = "insert into x2_blog(updatetime,thestate,typeid,title,content) values('".$ctime."',1,'".$typeid."','".$title."','".addslashes($content)."')";
        $conn->query("SET NAMES utf8");
	$conn->query($sql);
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
