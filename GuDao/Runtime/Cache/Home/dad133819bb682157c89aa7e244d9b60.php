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
	<div id="band" class="container content">
	</div>

	<!-- 底部 -->
	<back-to-top></back-to-top>
	<copyright></copyright>
</div>


<script type="text/javascript" src="/GuDao/Public/js/common/common.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/component.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/frame.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/band/band.js"></script>

<script>
$(function() {
	// 获取所有乐队首字母
	$.ajax({
		url: "/GuDao/index.php/Home/Band/getInitial",
		dataType: "json",
		success: function(result) {
			// console.log(result);
		}
	});
	
	// 按页获取乐队列表
	$.ajax({
		url: "/GuDao/index.php/Home/Band/getBandByPage",
		type: "GET",
		dataType: "json",
		data: {
			"pageIndex": 1,
			"pageSize": 10,
		},
		success: function(result) {
			console.log(result);
		}
	});

	// 按首字母获取乐队列表
	$.ajax({
		url: "/GuDao/index.php/Home/Band/getBandByPage",
		type: "GET",
		dataType: "json",
		data: {
			"pageIndex": 1,
			"pageSize": 10,
			"initial": "L"
		},
		success: function(result) {
			// console.log(result);
		}
	});
});
</script>

</body>
</html>