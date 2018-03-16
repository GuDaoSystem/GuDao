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
	<div id="home" class="container content">
		<div class="row">
			<div class="col-sm-8">
				<div class="new-notice">
					<div class="head">
						<p class="title">最新通知</p>
						<a href="../Notice" class="more">MORE</a>
					</div>
					<ul class="body">
						<li v-for="notice in notices">
							<p><span v-if="notice.notice_type == '1'" class="state">预售/</span><span v-if="notice.notice_type == '2'" class="state">取消/</span><span v-if="notice.notice_type == '3'" class="state">变更/</span>&ensp;{{notice.notice_content}}</p>
							<p class="time">{{notice.notice_time}}</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="calendar">
					<div class="head">
						<p class="title">演出时间表</p>
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
		</div>
		<div class="new-show">
			<div class="head">
				<p class="title">最新演出</p>
				<a href="../Show" class="more">MORE</a>
			</div>
			<ul class="row">
				<li v-for="show in newShows" class="col-xs-6 col-sm-3">
					<div class="show-list" :index="show.show_id">
						<img :src="'/GuDao/Public/img/show/' + show.show_poster">
						<p class="name text-overflow-ellipsis">{{show.show_name}}</p>
						<p>{{show.show_place}}</p>
						<p>{{show.show_time}}</p>
					</div>
				</li>
			</ul>
		</div>
		<div class="hot-show">
			<div class="head">
				<p class="title">热门演出</p>
				<a href="../Show" class="more">MORE</a>
			</div>
			<ul class="row">
				<li v-for="show in hotShows" class="col-xs-6 col-sm-3">
					<div class="show-list" :index="show.show_id">
						<img :src="'/GuDao/Public/img/show/' + show.show_poster">
						<p class="name text-overflow-ellipsis">{{show.show_name}}</p>
						<p>{{show.show_place}}</p>
						<p>{{show.show_time}}</p>
					</div>
				</li>
			</ul>
		</div>
		<div class="hot-band">
			<div class="head">
				<p class="title">热门乐队</p>
				<a href="../Band" class="more">MORE</a>
			</div>
			<ul class="row">
				<li v-for="band in hotBands" class="col-xs-6 col-sm-3">
					<div class="band-list" :index="band.band_id">
						<img v-if="band.band_cover" :src="'/GuDao/Public/img/band/' + band.band_id + '/' + band.band_cover">
						<img v-else src="/GuDao/Public/img/band/default.jpg">
						<p><span></span>{{band.band_name}}</p>
					</div>
				</li>
			</ul>
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
	
	
	
	
});
</script>

</body>
</html>