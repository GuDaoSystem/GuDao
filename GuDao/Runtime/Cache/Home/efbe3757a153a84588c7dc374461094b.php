<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/frame.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/show.css">
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
		<div class="top">
			<img src="/GuDao/Public/img/show/1.jpg" class="thumbnail"><div class="info">
				<span class="state yushou">/&ensp;预售</span>
				<p class="name">演出名称</p>
				<ul>
					<li>
						<span class="glyphicon glyphicon-headphones"></span>
						<p class="title">演出乐队：</p>
						<p class="msg"><a href="">乐队1</a>&ensp;/&ensp;<a href="">乐队2</a>&ensp;/&ensp;<a href="">乐队3</a>&ensp;/&ensp;<a href="">乐队4</a>&ensp;/&ensp;<a href="">乐队5</a>&ensp;/&ensp;<a href="">乐队6</a>&ensp;/&ensp;<a href="">乐队7</a>&ensp;/&ensp;<a href="">乐队2</a>&ensp;/&ensp;<a href="">乐队3</a>&ensp;/&ensp;<a href="">乐队4</a>&ensp;/&ensp;<a href="">乐队5</a>&ensp;/&ensp;<a href="">乐队6</a>&ensp;/&ensp;<a href="">乐队7</a></p>
					</li>
					<li>
						<span class="glyphicon glyphicon-map-marker"></span>
						<div class="title">
							<p>演出地点：</p>
							<p>具体地点：</p>
						</div>
						<div class="msg">
							<p class="place">演出地点地点</p>
							<p class="address">演出具体地点</p>
						</div>
					</li>
					<li>
						<span class="glyphicon glyphicon-time"></span>
						<p class="title">演出时间：</p>
						<p class="msg">2017年12月24日 19:00</p>
					</li>
					<li>
						<span class="glyphicon glyphicon-tag"></span>
						<p class="title">演出门票：</p>
						<ul class="msg">
							<li><span class="value">￥21</span>（预售票，不含酒）</li>
							<li><span class="value">￥21</span>（预售票，不含酒）</li>
							<li><span class="value">￥21</span>（预售票，不含酒）</li>
						</ul>
					</li>
				</ul>
				<button class="want"><span class="glyphicon glyphicon-eye-open"></span><span class="num">2333</span>人想看</button>
			</div>
		</div>

		<div>
			<ul class="tablist nav nav-tabs" role="tablist">
				<li class="tab1" role="presentation"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">详情</a></li>
				<li class="tab2" role="presentation"><a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">评论</a></li>
				<span class="underline"></span>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade" id="detail">
					<div class="desc">
						<p>演出信息演出信息</p>
						<p>演出信息演出信息演出信息演出信息演出信息演出信息</p>
						<p>演出信息演演出信息演出信息出信息</p>
						<p>演出信息演出演出信息演出信息演出信息演出信息演出信息演出信息信息</p>
						<p>演出信出信息</p>
						<p>演出信息演演出信息演出信息出信息</p>
						<p>演出信息演出信息</p>
						<p>演出演出信息演出信息演出信息演出信息演出信息演出信息息</p>
					</div>
					<ul class="band">
						
					</ul>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="comment">评论</div>
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
	var id = location.search.substr(1).split("=")[1];
	$.ajax({
		url: "/GuDao/index.php/Home/Show/getShowByID",
		// type: "POST",
		type: "GET",
		dataType: "json",
		data: {
			// "target": 1,
			"id": id,
			// "user_id": 4,
			// "show_id": 2,
			// "time": "2017-12-22"
		},
		success: function(result) {
			console.log(result);
		}
	});


	var tabIndex = ["#detail", "#comment"].indexOf(location.hash);
	$(".tablist li:eq(" + tabIndex +")").addClass("active");
	$(".tablist .underline").addClass("tab" + (tabIndex + 1));
	$(".tab-content div:eq(" + tabIndex +")").addClass("in").addClass("active");
	$(".tablist a").click(function () {
		location.href = location.toString().split("#")[0] + $(this).attr("href");
		$(".tablist .underline").removeClass("tab1 tab2").addClass($(this).parent()[0].className);
	});

});
</script>

</body>
</html>