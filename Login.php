<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns=" http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
	<title>登陆_LuckyXue</title>
	<link rel="shortcut icon" type="image/x-icon" href="Images/ico.png" />
	<link href="Css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<div class="main">
		<div class="j_main">
			<div class="rehead">
				<div class="j_title">
					<hgroup>
					<h1 class="site-title">
						<a href="#" title="康芒JS" rel="home">登陆页面</a>
					</h1>
					</hgroup>
				</div>


			</div>
			<div class="content">
				<form action="Login.inc.php" method="post">
					<p class="comment-form-author">
						<label for="author" style="float: left;">昵称 <span class="required">*</span></label><br />
						<input id="author" name="author" type="text" class="reinput"
							value="" aria-required="true">
					
					</p>
					<p class="comment-form-author">
						<label for="author" style="float: left;">密码 <span class="required">*</span></label><br />
						<input id="password" name="password" type="password"
							class="reinput" value="" aria-required="true">
					
					</p>
					<div class="comment-form-author">
						<div style="float: left;">
							<input type="checkbox" name="isrem" /> 记住密码
						</div>
						<div>
							<a href="" style="margin-left: 180px;"> 忘记密码</a>
						</div>
					</div>
					<p class="comment-form-author">
						<input style="float: left; width: 100px; height: 35px;"
							name="submit" type="submit" id="submit" value="提交信息" />
					</p>
				</form>
				<div class="clear"></div>
				<br />
				<hr align="center" />

			</div>
		</div>
	</div>
</body>
</html>
