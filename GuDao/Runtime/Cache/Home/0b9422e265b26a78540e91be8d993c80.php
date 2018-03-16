<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/frame.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/notice/notice.css">
<script type="text/javascript" src="/GuDao/Public/js/common/jquery-3.2.1.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/bootstrap.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/vue.js"></script>
</head>
<body>

<div id="gudao">	
	<!-- 导航条 -->
	<navbar></navbar>

	<!-- 内容 -->
	<div id="notice" class="container content">
		<ul class="condition">
			<li class="active"><a>全部</a></li>|<li><a>预售</a></li>|<li><a>取消</a></li>|<li><a>变更</a></li>
		</ul>
		<div v-show="!notices" class="no-data">
			<img src="/GuDao/Public/img/common/noData.png">
			<span></span>
			<p>没有相关数据</p>
		</div>
		<ul class="list">
			<li v-for="notice in notices">
				<span v-if="notice.notice_type == '1'" class="state">预售/</span><span v-if="notice.notice_type == '2'" class="state">取消/</span><span v-if="notice.notice_type == '3'" class="state">变更/</span><p>{{notice.notice_content}}</p><span class="time">{{notice.notice_time}}</span>
			</li>
		</ul>
	</div>

	<!-- 底部 -->
	<back-to-top></back-to-top>
	<copyright></copyright>
</div>


<script type="text/javascript" src="/GuDao/Public/js/common/common.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/component.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/frame.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/notice/notice.js"></script>

<script>
$(function() {
	// 获取全部
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/Notice/getNoticeByPage",
	// 	type: "GET",
	// 	dataType: "json",
	// 	data: {
	// 		"pageIndex": 1,
	// 		"pageSize": 10
	// 	},
	// 	success: function(result) {
	// 		console.log(result);
	// 	}
	// });
	
	// // 按类型获取
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/Notice/getNoticeByPage",
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