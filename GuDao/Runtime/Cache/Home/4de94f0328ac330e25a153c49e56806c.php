<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/frame.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/user/forgetPassword.css">
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
		<ul class="tab">
			<li class="active"><span></span>获取验证码</li>
			<li><span></span>重设密码</li>
			<li><span></span>完成</li>
			<span class="underline tab1"></span>
		</ul>
		<div class="tab-content">
			<div class="step step1">
				<form>
					<div class="input">
						<span class="glyphicon glyphicon-envelope"></span>
						<input type="email" name="email" placeholder="邮箱" autocomplete="off">
					</div>
					<div class="input">
						<span class="glyphicon glyphicon-check"></span>
						<input type="text" name="code" placeholder="验证码" autocomplete="off">
						<button class="getCode">获取验证码</button>
					</div>
					<button class="next">下一步</button>
				</form>
			</div>
			<div class="step step2">
				<form>
					<div class="input">
						<span class="glyphicon glyphicon-lock"></span>
						<input type="password" name="password" placeholder="密码">
					</div>
					<div class="input">
						<span class="glyphicon glyphicon-lock"></span>
						<input type="password" name="confirmPassword" placeholder="确认密码">
					</div>
					<button class="next">下一步</button>
				</form>
			</div>
			<div class="step step3">
				<div>
					<span class="glyphicon glyphicon-ok-circle"></span>
					<p>已重设密码并登录成功，<span class="countdown">3</span>秒后为你<a href="../Index/home">返回首页</a></p>
				</div>
			</div>
		</div>
	</div>

	<!-- 底部 -->
	<copyright></copyright>
</div>


<script type="text/javascript" src="/GuDao/Public/js/common/common.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/component.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/frame.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/user/forgetPassword.js"></script>

<script>
$(function() {
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/User/checkCode",
	// 	type: "POST",
	// 	dataType: "json",
	// 	data: {
	// 		// // "id": 4,
	// 		// "password": md5("wuyinglin"),
	// 		"email": "ng.winglam@qq.com",
	// 		"code": "1234"
	// 	},
	// 	success: function(result) {
	// 		console.log(result);
	// 	}
	// });
});
</script>

</body>
</html>