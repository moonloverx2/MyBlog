<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:wb="http://open.weibo.com/wb">
<head>
<meta charset="UTF-8">
<meta property="wb:webmaster" content="07d906ff47c2b0a9" />
	<title>首页_LuckyXue</title>

	<meta name="keywords" content="薛建东,luckyxue,c#,PHP,js,jQuery,mysql,sqlserver,linux,小说" />
    <meta name="description" content="薛建东(luckyxue、二月十六)的博客. 主要分享关于C#、PHP、js、jQuery、linux、sql server、mysql的相关技术,和生活记录，以及小说文章。http://www.luckyxue.com/。" />
    <link rel="canonical" href="http://www.luckyxue.com/" />
	<link rel="shortcut icon" type="image/x-icon" href="/Images/ico.png" />
	<link href="/Css/style.css" rel="stylesheet" type="text/css" />
	<script src="/Js/Ueditor/ueditor.parse.js"></script>
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js"
		type="text/javascript" charset="utf-8"></script>
	<script>

	uParse('#b_content', {
	    rootPath: '/Js/Ueditor/'
	})

</script>

</head>
<body>

	<div class="main">
		<div class="j_main">
			<?php require 'Tempalate/Head.html';?>
			
			<div class="content">
				<div class="j_list">

				<?php
				require 'Helper/Dbconnection.php';
                         	require 'Helper/FuncHelper.php';		
				$Search = $_GET ["Search"];
				$cPage1 = $_GET ["cPage"];
				$type = $_GET ["Type"];
				$arr = explode ( '/', $type );
				if ($cPage1 == 0) {
					$cPage1 = 1;
				}
				
				if (empty ( $arr [0] )) {
					$type = "Technology";
				}
				
				switch ($type) {
					case "Technology" :
						$typeid = "1";
						break;
					case "Life" :
						$typeid = "2";
						break;
					case "Novel" :
						$typeid = "3";
						break;
				}
				
				if (! empty ( $Search )) {
					$sql = "Select * from x2_blog where Title like '%" . $Search . "%' or Content like '%" . $Search . "%' order by UpdateTime desc limit " . (($cPage1 - 1) * 8) . ",8 ";
					$countsql = "Select count(*) as num from x2_blog where Title like '%" . $Search . "%' or Content like '%" . $Search . "%'";
				} else {
					$sql = "Select * from x2_blog where TypeId = " . $typeid . " order by UpdateTime desc limit " . (($cPage1 - 1) * 8) . ",8 ";
					$countsql = "Select count(*) as num from x2_blog  where TypeId = " . $typeid . "";
				}
				$conn->query ( "SET NAMES utf8" );
				$result = $conn->query ( $sql );
				$result1 = $conn->query ( $countsql );
				if ($result1->num_rows > 0) {
					while ( $row = $result1->fetch_assoc () ) {
						$cout = ceil($row["num"] / 8);
					}
				}
				if ($cout < 1) {
					$cout = 1;
				}
				
				if ($result->num_rows > 0) {
					while ( $row = $result->fetch_assoc () ) {
						switch ($row["TypeId"]) {
							case 1 :
								$showtype = "Technology";
								break;
							case 2 :
								$showtype = "Life";
								break;
							case 3 :
								$showtype = "Novel";
								break;
						}
						echo "<div class=\"c_title\"><a href=\"/" . $showtype . "/" . date ( 'YmdHis', strtotime ( $row ["UpdateTime"] ) ) . ".html\">" . $row ["Title"] . "</a></div><div style=\"text-indent:3em;\" id=\"b_content\">" .wpgo_substrUtf8($row ["Content"],900 ) . "</div>";
						echo "<div class=\"c_footer\"><span>Filed in <a href=\"/" . $showtype . "\">" . $showtype . "</a> &nbsp;&nbsp;Time " .date('Y-m-d',strtotime($row["UpdateTime"])) . "</span><hr align=\"center\" style=\"color: white;\" /></div>";
					}
				} else {
					echo "0 results";
				}
				?>
				
             <div class="clear"></div>
					<div class="j_page">Pages:  <?php include 'Helper/Pages.php'; $type = empty($Search)?$type:""; GetPages($type,$cout,$cPage1,$Search)?></div>
				</div>
            <?php require 'Tempalate/Left.html';?>
				<div class="clear"></div>

				<br />
				<hr align="center" />
             <?php include 'Tempalate/Footer.html';?>
			</div>
		</div>
	</div>
</body>
</html>
