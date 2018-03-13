<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/frame.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/show/show.css">
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
		<!-- 筛选条件 -->
		<div class="condition">
			<ul class="sort">
				<p>演出排序</p>
				<li class="active"><a>按时间</a></li>
				<li><a>按热度</a></li>
			</ul>
			<ul class="place">
				<p>演出地点</p>
				<li class="active"><a>全部</a></li>
				<li v-for="item in place"><a>{{item}}</a></li>
			</ul>
			<ul class="state">
				<p>演出状态</p>
				<li class="active"><a>全部</a></li>
				<li><a>预售</a></li>
				<li><a>取消</a></li>
				<li><a>变更</a></li>
				<li><a>结束</a></li>
			</ul>
		</div>

		<!-- 演出列表 -->
		<div v-show="!list">NOT FOUND</div>
		<ul class="row show-list">
			<li v-for="item in list" class="col-sm-6 col-md-4">
				<div class="show-content" :index="item.show_id">
					<img :src="'/GuDao/Public/img/show/' + item.show_poster"><div class="info">
						<p class="name text-overflow-ellipsis">{{item.show_name}}</p>
						<p class="band text-overflow-ellipsis"><span class="glyphicon glyphicon-headphones"></span><span v-for="band in item.band">{{band.band_name}}&ensp;/&ensp;</span></p>
						<p class="place text-overflow-ellipsis"><span class="glyphicon glyphicon-map-marker"></span>{{item.show_place}}</p>
						<p class="time text-overflow-ellipsis"><span class="glyphicon glyphicon-time"></span>{{item.show_time}}</p>
						<p class="want"><span class="glyphicon glyphicon-eye-open"></span><span class="num">{{item.want}}</span>人想看</p>
						<span v-if="item.show_state == '1'" class="state yushou">/&ensp;预售</span>
						<span v-else-if="item.show_state == '2'" class="state quxiao">/&ensp;取消</span>
						<span v-else-if="item.show_state == '3'" class="state biangeng">/&ensp;变更</span>
						<span v-else-if="item.show_state == '4'" class="state">/&ensp;结束</span>
					</div>
				</div>
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
<script type="text/javascript" src="/GuDao/Public/js/show/show.js"></script>

<script>
$(function() {
});
</script>

</body>
</html>