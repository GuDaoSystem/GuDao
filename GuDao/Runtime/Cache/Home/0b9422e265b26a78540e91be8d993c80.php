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
	<div class="container content">
	</div>

	<!-- 底部 -->
	<back-to-top></back-to-top>
	<copyright></copyright>
</div>


<script type="text/javascript" src="/GuDao/Public/js/common/common.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/component.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/frame.js"></script>

<script>
new Vue({
	el: '#gudao',
	components: {
		"navbar": navbar,
		"back-to-top": backToTop,
		"copyright": copyright
	}
});
$(function() {
	// 获取全部
	$.ajax({
		url: "/GuDao/index.php/Home/Notice/getNoticeByPage",
		type: "GET",
		dataType: "json",
		data: {
			"pageIndex": 1,
			"pageSize": 10
		},
		success: function(result) {
			console.log(result);
		}
	});
	
	// // 按类型获取
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/Notice/getNoticeByType",
	// 	type: "GET",
	// 	dataType: "json",
	// 	data: {
	// 		"pageIndex": 1,
	// 		"pageSize": 10,
	// 		"type": 1
	// 	},
	// 	success: function(result) {
	// 		console.log(result);
	// 	}
	// });
});
</script>

</body>
</html>