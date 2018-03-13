<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/frame.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/index/home.css">
<script type="text/javascript" src="/GuDao/Public/js/common/jquery-3.2.1.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/bootstrap.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/vue.js"></script>
</head>
<body>

<div id="gudao">	
	<!-- 导航条 -->
	<navbar></navbar>

	<!-- 内容 -->
	<div class="container content">
		<!-- 演出时间表 -->
		<div class="calendar">
			<div class="head">
				<div class="title">演出时间表</div>
				<div class="selector">
					<span class="left glyphicon glyphicon-chevron-left"></span>
					<p></p>
					<span class="right glyphicon glyphicon-chevron-right"></span>
				</div>
				<div class="form">
					<input class="year" type="text" name="year" maxlength="4">年<input class="month" type="text" name="month" maxlength="2">月<span class="glyphicon glyphicon glyphicon-ok"></span>
				</div>
			</div>
			<div class="body">
				<div class="week">
					<div>日</div><div>一</div><div>二</div><div>三</div><div>四</div><div>五</div><div>六</div>
				</div>
				<div class="day"></div>
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
<script type="text/javascript" src="/GuDao/Public/js/index/home.js"></script>

<script>
$(function() {
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/Index/getNotice",
	// 	dataType: "json",
	// 	success: function(result) {
	// 		console.log(result);
	// 	}
	// });
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/Index/getRecentShow",
	// 	dataType: "json",
	// 	success: function(result) {
	// 		console.log(result);
	// 	}
	// });
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/Index/getHotShow",
	// 	dataType: "json",
	// 	success: function(result) {
	// 		console.log(result);
	// 	}
	// });
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/Index/getHotBand",
	// 	dataType: "json",
	// 	success: function(result) {
	// 		console.log(result);
	// 	}
	// });
});
</script>

</body>
</html>