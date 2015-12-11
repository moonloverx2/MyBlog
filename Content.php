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
				<div class="j_list" id="b_content">

           <?php 
// 				$HtmlPath = $_GET["Clo"]."/".$_GET["y"]."/".$_GET["m"]."/".$_GET["d"]."/".$_GET["f"];
           $HtmlPath = $_GET["Clo"];
            if(!empty($HtmlPath))
                {
                	require $HtmlPath.".html";
                }
				?>
				
				<?php 
				
				?>            
				
				</div>
				
            <?php require 'Tempalate/Left.html';?>

            <div class="j_commentlist">
					<span style="font-size: 20px; color: blue">Comments:</span>
					<hr align="center" />
					<ol style="list-style-type: none;">

							<?php 
							//评论
				             require 'Helper/Dbconnection.php';
				             $BlogId = $_GET["BlogId"];
			                 echo "<input type=\"hidden\" id=\"BlogId\" value=".$BlogId.">";
				             $sql = "Select * from Comment where BlogId = ".$BlogId." order by ComTime desc";
			                 $conn->query ( "SET NAMES utf8" );
				             $result = $conn->query ( $sql );
							 if ($result->num_rows > 0) {
					          while ( $row = $result->fetch_assoc () ) {
					        	echo "<li class=\"j_comment\"><span class=\"j_comname\"><a style=\"color: blue;\">".$row["ComName"]."</a> | ".$row["ComTime"]."</span><p >".$row["Comment"]."</p></li>";
						
					            }
							 }
							?>
						
					</ol>
					
					
					<div class="c_input">
					
					<p class="comment-form-comment">
						<label for="author" style="float: left;">Name: </label><br />
						<input id="ComName" name="ComName" type="text" class="reinput" value="" aria-required="true"/>
					
					</p>
					<p class="comment-form-comment">
						<label for="author" style="float: left;">Email: </label><br />
						<input id="Email" name="Email" type="text" class="reinput" value="" aria-required="true"/>
					
					</p>
					<p class="comment-form-area">
						<label for="author" style="float: left;">Comment: </label><br />
					   <textarea class="retextarea" name="Comment" id="Comment"></textarea><br/>&nbsp;<br/>
					   <input style="float:left;" onclick="savecomment()" type="submit" value="提交"/>
					</p>
                    
					</div>
				</div>


				<div class="clear"></div>
				<br />
				<hr align="center" />
             <?php include 'Tempalate/Footer.html';?>
			</div>
		</div>
	</div>
</body>

	<script type="text/javascript">

	 function savecomment1()
	    {
		    alert('sss');
		    }
    function savecomment()
    {
    	if($("#ComName").val()=="")
        {
            alert("Please enter a name !");
            $("#ComName").focus();
            return false;
            }
    	if($("#Comment").val()=="")
        {
            alert("Please enter a comment !");
            $("#Comment").focus();
            return false;
            }
        $.ajax({
             type:"POST",
             url:"/Comment.inc.php",
             data:{
            "BlogId":$("#BlogId").val(),
            "ComName":$("#ComName").val(),
            "Email":$("#Email").val(),
            "Comment":$("#Comment").val()
            },
            dataType:"JSON",
            success:function(data)
            {
                if(data)
                {
                    alert("保存成功！");
                    window.location.reload();
                    }
                else
                {
                    alert("保存失败！");
                    }
                }
            });
        }
	
    </script>
</html>
