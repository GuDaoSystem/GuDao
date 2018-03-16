<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/frame.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/user/index.css">
<script type="text/javascript" src="/GuDao/Public/js/common/jquery-3.2.1.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/bootstrap.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/bootstrap-datetimepicker.js"></script>
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
			<img v-if="info.headshot" :src="'/GuDao/Public/img/user/' + info.headshot" class="thumbnail">
			<img v-else src="/GuDao/Public/img/user/default.jpg" class="thumbnail"><div class="info">
				<div class="data">
					<div class="want">
						<p>想看演出</p>
						<p class="num">{{want}}</p>
					</div><div class="support">
						<p>支持乐队</p>
						<p class="num">{{support}}</p>
					</div>
				</div>
				<p class="name">{{info.username}}</p>
				<!-- 信息列表 -->
				<ul>
					<li class="gender">
						<span class="glyphicon glyphicon-user"></span>
						<p v-if="info.gender == 'M'">男</p>
						<p v-else>女</p>
					</li>
					<li class="age">
						<span class="glyphicon glyphicon-hourglass"></span>
						<p>{{info.age}}</p>
					</li>
					<li class="intro">
						<span class="glyphicon glyphicon-bookmark"></span>
						<p>{{info.intro}}</p>
					</li>
				</ul>
				<!-- 修改按钮 -->
				<div class="modify-btn">
					<a class="modify-info"><span class="glyphicon glyphicon-pencil"></span>修改基本信息</a>
					<a href="forgetPassword" class="modify-password"><span class="glyphicon glyphicon-lock"></span>修改密码</a>
				</div>
			</div><div class="modify-form">
				<input class="name" type="text" name="name" :value="info.username">
				<div class="gender">
					<span class="glyphicon glyphicon-user"></span>
					<p>性别</p>
					<div class="radio-box">
						<div class="radio male">
							<span class="outer"></span><span class="inner"></span>
							<p>男</p>
						</div>
						<div class="radio female">
							<span class="outer"></span><span class="inner"></span>
							<p>女</p>
						</div>
					</div>
				</div>
				<div class="birthday">
					<span class="glyphicon glyphicon-hourglass"></span>
					<p>出生日期</p>
					<input type="text" name="birthday" :value="info.birthday" id="datetimepicker" readonly="true">
				</div>
				<div class="intro">
					<span class="glyphicon glyphicon-bookmark"></span>
					<p>用户简介</p>
					<textarea maxlength="100">{{info.intro}}</textarea>
					<p class="count"><span>0</span>/100</p>
				</div>
				<div class="button">
					<button class="confirm">确定</button>
					<button class="cancel">取消</button>
				</div>
			</div>
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
				<div role="tabpanel" class="tab-pane fade" id="activity">
					<ul>
						<li v-for="item in activity">
							<div class="left">
								<p>{{item.time}}</p>
							</div><span class="dot-span"></span><div class="right">
								<p v-if="item.type == 'show'">想看&ensp;<a :href="'../Show/detail?id=' + item.show.show_id">{{item.show.show_name}}</a></p>
								<p v-if="item.type == 'band'">支持&ensp;<a :href="'../Band/detail?id=' + item.band.band_id">{{item.band.band_name}}</a></p>
								<div :class="{band: item.type == 'band'}" class="pic">
									<div class="content">
										<div class="triangle">
											<span class="outer triangle-span"></span><span class="inner triangle-span"></span>
										</div>
										<img v-if="item.type == 'show'" :src="'/GuDao/Public/img/show/' + item.show.show_poster">
										<img v-if="item.type == 'band' && item.band.band_cover" :src="'/GuDao/Public/img/band/' + item.band.band_id + '/' + item.band.band_cover">
										<img v-if="item.type == 'band' && !item.band.band_cover" src="/GuDao/Public/img/band/default.jpg">
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="message">
					<ul>
						<li v-for="message in reply" class="close-state" :comment="message.comment_id" :user="message.user_id">
							<div :class="{read: message.read == 1}" class="content">
								<p><a :href="'user?id=' + message.user_id" class="name">{{message.user.username}}</a>&ensp;回复了你的评论：{{message.reply_content}}</p>
								<span class="open-btn glyphicon glyphicon-triangle-bottom"></span>
								<span class="close-btn glyphicon glyphicon-triangle-top"></span>
							</div>
							<div class="reply-box">
								<textarea maxlength="100"></textarea>
								<div class="bottom">
									<p><span>0</span>/100</p>
									<button class="send">发送</button>
								</div>
							</div>
						</li>
					</ul>
				</div>
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
	// $('#datetimepicker').datetimepicker({
	// 	format: "yyyy-mm-dd",
	// 	autoclose: true,
	// 	minView: "month"
	// });


});
</script>

</body>
</html>