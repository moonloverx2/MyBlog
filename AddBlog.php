<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:wb="http://open.weibo.com/wb">
<head>
<meta charset="UTF-8">
	<title>发布Blog_LuckyXue</title>
   <link rel="shortcut icon" type="image/x-icon" href="Images/ico.png" />
	<link href="Css/style.css" rel="stylesheet" type="text/css" />
	<script>



</script>

</head>
<body>
<?php
require 'Helper/Session.php';
CheckUser();
?>
	<div class="main">
		<div class="j_main">
			<div class="a_head">
				<div class="j_title">
					<hgroup>
					<h1 class="site-title">
						<a href="#" title="LuckyXue" rel="home">LuckyXue</a>
					</h1>
					<span class="site-description">总会想、应该说点什么。</span> </hgroup>
				</div>

			</div>
			<div class="content">
				<table>
					<tr>
						<td width="10%" height="60px">分类：</td>
						<td width="90%"><select id="typeid"
							style="float: left; width: 100px; height: 30px;"><option
									value="1">技术</option>
								<option value="2">生活</option>
								<option value="3">小说</option></select></td>
					</tr>
					<tr>
						<td width="10%" height="80px">标题：</td>
						<td width="90%"><input type="text"
							style="float: left; width: 500px; height: 30px;" name="title"
							id="title" /></td>
					</tr>
					<tr>
						<td width="10%" height="400px">内容：</td>
						<td width="90%"><script id="container" name="content"
								type="text/plain"></script></td>
					</tr>
					<tr>
						<td colspan="2" height="60px"><input type="button"
							style="float: center; width: 100px; height: 40px;" value="保存"
							onclick="Add()" /></td>
					</tr>
				</table>

				<script type="text/javascript" src="/Js/jquery.1.7.2.js"></script>
				<script type="text/javascript" src="/Js/Ueditor/ueditor.config.js"></script>
				<!-- 编辑器源码文件 -->
				<script type="text/javascript" src="/Js/Ueditor/ueditor.all.js"></script>
				<!-- 实例化编辑器 -->
				<script type="text/javascript">
        var ue = UE.getEditor('container',{
        	toolbars: [
        	           [
        	               'undo', //撤销
        	               'redo', //重做
        	               'bold', //加粗
        	               'italic', //斜体
        	               'underline', //下划线
        	               'strikethrough', //删除线
        	               'forecolor', //字体颜色
        	               'indent',
                               'backcolor', //背景色
        	               'formatmatch', //格式刷
        	               'preview', //预览
        	               'horizontal', //分隔线
        	               'removeformat', //清除格式


        	               'simpleupload', //单图上传
        	               'insertimage', //多图上传
        	               'link', //超链接
        	               'emotion', //表情
        	               'spechars', //特殊字符
        	               'searchreplace', //查询替换
        	               
        	              // 'fullscreen', //全屏

        	               'attachment', //附件

        	               'lineheight', //行间距
        	               'edittip ', //编辑提示
        	               'autotypeset', //自动排版
        	               'background', //背景

        	               'scrawl', //涂鸦
        	               'inserttable', //插入表格
        	               'insertcode', //代码语言
        	               'fontfamily', //字体
        	               'fontsize', //字号
        	           ]
        	       ],

            initialFrameHeight:400});

        function Add()
        {

        	   $.ajax({
    		    url:'AddBlog.inc.php',
             data:{
                    typeid :$('#typeid').val(),
                    title:$('#title').val(),
                    content:ue.getContent(),
                 },
             type:'post',
             dataType:'text',
             success:function(msg){
             alert(msg);
                     
                 }
    		   }); 
            }
        
    </script>
			</div>
		</div>
	</div>
</body>
</html>
