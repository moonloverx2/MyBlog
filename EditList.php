<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:wb="http://open.weibo.com/wb">
<head>
<meta charset="UTF-8">
	<title>编辑_LuckyXue</title>
	<link rel="shortcut icon" type="image/x-icon" href="/Images/ico.png" />
	<link href="/Css/style.css" rel="stylesheet" type="text/css" />
	<script src="/Js/Ueditor/ueditor.parse.js"></script>
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js"
		type="text/javascript" charset="utf-8"></script>
	<script>

	uParse('#b_content', {
	    rootPath: '/Js/Ueditor/'
	})
	
	function DeleteBlog(id,time,type) {
		 $.ajax({
 		    url:'EditList.inc.php',
          data:{
                 identifier :id,
                 updatetime:time,
                       type :type
              },
          type:'post',
          dataType:'text',
          success:function(msg){
        
          window.location.reload();  
              }
 		   }); 
	}

</script>

</head>
<body>
<?php
require 'Helper/Session.php';
CheckUser();
?>
	<div class="main">
		<div class="j_main">
			
		
		<div class="head">
				<div class="j_title">
					<hgroup>
					<h1 class="site-title">
						<a href="#" title="LuckyXue" rel="home">LuckyXue</a>
					</h1>
					<span class="site-description">总会想、应该说点什么。</span> </hgroup>
				</div>
				<div class="j_conml">
					<form action="/EditList.php" methd="POST">
						<input type="text" value="关键字" style="color: #bfbfbf;"
							onfocus="if(value=='关键字'){this.style.color='#000';value=''}"
							onblur="if(value==''){this.style.color='#bfbfbf';value='关键字'}"
							name="Search" id="Search" style="vertical-align: middle" /> <input
							style="position: relative; width: 22px; height: 22px; vertical-align: middle"
							type="image" src="/Images/sea.jpg" />&nbsp;

					</form>
				</div>
				<div class="b_colum">

					<ul class="b_ul">
						<li><a href="EditList.php?Type=Technology">技术</a></li>
						<li><a href="EditList.php?Type=Life">生活</a></li>
						<li><a href="EditList.php?Type=Novel">小说</a></li>
					</ul>
				</div>
			</div>
			
			
			<div class="content">
				<div class="j_list" id="b_content">

				<?php 
				require 'Helper/Dbconnection.php';
				
				$Search = $_GET["Search"];
				$cPage1=$_GET["cPage"];
				$type=$_GET["Type"];
				$arr = explode('/',$type);
				if($cPage1==0)
				{
					$cPage1=1;
				}

				if(empty($arr[0]))
				{
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
				
				if(!empty($Search))
				{
					$sql = "Select * from x2_blog where Title like '%".$Search."%' or Content like '%".$Search."%' order by UpdateTime desc limit ".(($cPage1-1)*8).",8 ";
                                        $countsql = "Select count(*) as num from x2_blog where Title like '%" . $Search . "%' or Content like '%" . $Search . "%'";
				}
				else
				{
					$sql = "Select * from x2_blog where TypeId = ".$typeid." order by UpdateTime desc limit ".(($cPage1-1)*8).",8 ";
				        $countsql = "Select count(*) as num from x2_blog  where TypeId = " . $typeid . "";
                                }
                                $conn->query ( "SET NAMES utf8" );
                                $result = $conn->query ( $sql );
                                $result1 = $conn->query ( $countsql );
                                
				#$result = $conn->query($sql);
				#$result1 = $conn->query("Select count(*) as num from x2_blog");
				if ($result1->num_rows > 0) {
					while($row = $result1->fetch_assoc()) {$cout=($row["num"]/8);}
				}
				if($cout<1)
				{
					$cout =1;
				}
				
				if ($result->num_rows > 0) {
					echo "<table width=\"100%\">";
					echo "<tr><td>分类</td><td>标题</td><td>时间</td><td>操作</td></tr>";
					while($row = $result->fetch_assoc()) {

						echo "<tr><td>".$type."</td><td>".mb_substr($row["Title"],0,10,'utf-8')."</td><td>".$row["UpdateTime"]."</td><td><a href=\"/AddBlog.php\">添加</a>&nbsp;<a href=\"/Edit.php?Identifier=".$row["Identifier"]."\">编辑</a>&nbsp;<a href=\"#\" onclick=\"DeleteBlog(".$row["Identifier"].",'".$row["UpdateTime"]."','".$type."')\">删除</a></td></tr>";
					}
					echo "</table>";
				} else {
					echo "0 results";
				}
				?>
				
             <div class="clear"></div>
				<div class="j_page">Pages:  <?php include 'Helper/Pages.php'; GetPages("EditList/".$type,$cout,$cPage1,$Search)?></div>
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
