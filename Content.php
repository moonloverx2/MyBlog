<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:wb="http://open.weibo.com/wb">
<head>
<meta charset="UTF-8">
	<title>首页_LuckyXue</title>
	<meta name="keywords" content="">
	<link rel="shortcut icon" type="image/x-icon" href="/Images/ico.png" />
	<link href="/Css/style.css" rel="stylesheet" type="text/css" />
	<script src="/Js/Ueditor/ueditor.parse.js"></script>
	<script src="/Js/jquery.1.7.2.js"></script>	
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js"
		type="text/javascript" charset="utf-8"></script>
	<script>

	uParse('#b_content', {
	    rootPath: '/Js/Ueditor/'
	})

	$(function(){
	   document.title = $('.c_title a').text()+"_LuckyXue";
	})
</script>

</head>
<body>

	<div class="main">
		<div class="j_main">
			<?php require 'Tempalate/Head.html';?>
			
			<div class="content">
				<div class="j_list"  id="b_content">

           <?php 
// 				$HtmlPath = $_GET["Clo"]."/".$_GET["y"]."/".$_GET["m"]."/".$_GET["d"]."/".$_GET["f"];
           $HtmlPath = $_GET["Clo"];
            if(!empty($HtmlPath))
                {
                	require $HtmlPath.".html";
                }
				?>
				
            
				
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