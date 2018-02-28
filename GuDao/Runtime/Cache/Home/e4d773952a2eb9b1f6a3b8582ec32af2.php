<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/frame.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/login.css">
<script type="text/javascript" src="/GuDao/Public/js/common/jquery-3.2.1.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/md5.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/jquery.validate.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/bootstrap.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/vue.js"></script>
</head>
<body>

<div id="gudao">	
	<!-- 导航条 -->
	<navbar></navbar>

	<!-- 内容 -->
	<div class="container content">
		<div class="left">
			<img src="/GuDao/Public/img/login.png">
		</div>
		<div class="right">
			<form id="login">
				<div class="input">
					<span class="glyphicon glyphicon-envelope"></span>
					<input type="email" name="email" placeholder="邮箱" autocomplete="off">
				</div>
				<div class="input">
					<span class="glyphicon glyphicon-lock"></span>
					<input type="password" name="password" placeholder="密码">
				</div>
				<div class="other">
					<div class="checkbox">
						<span class="uncheck"></span>
						<span class="checked"></span>
						<p>下次自动登录</p>
					</div>
					<a href="../User/forgetPassword">忘记密码？</a>
				</div>
				<button>登录</button>
				<p class="register">没有账号？点击<a href="">注册</a></p>
			</form>
		</div>
	</div>

	<!-- 底部 -->
	<back-to-top></back-to-top>
	<copyright></copyright>
</div>


<script type="text/javascript" src="/GuDao/Public/js/common/common.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/component.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/frame.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/login.js"></script>

<script>
$(function() {
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/Index/autoLogin",
	// 	type: "POST",
	// 	dataType: "json",
	// 	data: {
	// 		// "email": "ng.winglam@qq.com",
	// 		// "password": md5("wuyinglin"),
	// 		// "autoLogin": true
	// 		// "id": 1,
	// 		// "token": "f1b0e4b5b15802b5c391ae418e4cf357"
	// 	},
	// 	success: function(result) {
	// 		console.log(result);
	// 	}
	// });
});
</script>

</body>
</html>