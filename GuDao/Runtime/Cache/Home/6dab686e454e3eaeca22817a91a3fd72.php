<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/frame.css">
<script type="text/javascript" src="/GuDao/Public/js/common/jquery-3.2.1.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/bootstrap.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/vue.js"></script>
</head>
<body>

<div id="gudao">	
	<!-- 导航条 -->
	<navbar></navbar>

	<!-- 内容 -->
	<div id="index" class="container content">
		<!-- 基本信息 -->
		<div class="top">
		</div>

		<!-- 标签页 -->
		<div>
			<ul class="tablist nav nav-tabs" role="tablist">
				<li class="tab1" role="presentation"><a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">动态</a></li>
				<li class="tab2" role="presentation"><a href="#message" aria-controls="message" role="tab" data-toggle="tab">消息</a></li>
				<li class="tab3" role="presentation"><a href="#show" aria-controls="show" role="tab" data-toggle="tab">演出</a></li>
				<li class="tab4" role="presentation"><a href="#band" aria-controls="band" role="tab" data-toggle="tab">乐队</a></li>
				<span class="underline"></span>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade" id="activity">动态列表</div>
				<div role="tabpanel" class="tab-pane fade" id="message">消息列表</div>
				<div role="tabpanel" class="tab-pane fade" id="show">演出列表</div>
				<div role="tabpanel" class="tab-pane fade" id="band">乐队列表</div>
			</div>
		</div>
	</div>

	<!-- 底部 -->
	<back-to-top></back-to-top>
	<copyright></copyright>
</div>


<script type="text/javascript" src="/GuDao/Public/js/common/common.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/component.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/frame.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/user/index.js"></script>

<script>
$(function() {
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/User/getCommentByUser",
	// 	type: "GET",
	// 	// type: "POST",
	// 	dataType: "json",
	// 	data: {
	// 		"id": 4,
	// 		"password": md5("wuyinglin"),
	// 		//"email": "ng.winglam@qq.com"
	// 	},
	// 	success: function(result) {
	// 		console.log(result);
	// 	}
	// });
});
</script>

</body>
</html>