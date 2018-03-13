<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/frame.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/Show/show.css">
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
				<span v-if="show.show_state == '1'" class="state yushou">/&ensp;预售</span>
				<span v-else-if="show.show_state == '2'" class="state quxiao">/&ensp;取消</span>
				<span v-else-if="show.show_state == '3'" class="state biangeng">/&ensp;变更</span>
				<span v-else-if="show.show_state == '4'" class="state">/&ensp;结束</span>
				<p class="name">{{show.show_name}}</p>
				<ul>
					<li>
						<span class="glyphicon glyphicon-headphones"></span>
						<p class="title">演出乐队：</p>
						<p class="msg">
							<span v-for="band, index in bands">
								<span v-if="index + 1 == bands.length"><a :href="'../Band/detail?id=' + band.band_id">{{band.band_name}}</a></span>
								<span v-else><a :href="'../Band/detail?id=' + band.band_id">{{band.band_name}}</a>&ensp;/&ensp;</span>
							</span>
						</p>
					</li>
					<li>
						<span class="glyphicon glyphicon-map-marker"></span>
						<div class="title">
							<p>演出地点：</p>
							<p>具体地点：</p>
						</div>
						<div class="msg">
							<p class="place">{{show.show_place}}</p>
							<p class="address">{{show.show_address}}点</p>
						</div>
					</li>
					<li>
						<span class="glyphicon glyphicon-time"></span>
						<p class="title">演出时间：</p>
						<p class="msg">{{show.show_time}}</p>
					</li>
					<li>
						<span class="glyphicon glyphicon-tag"></span>
						<p class="title">演出门票：</p>
						<p v-if="show.show_ticket == 0" class="msg">免票</p>
						<p v-else class="msg"><span class="value">￥{{show.show_ticket}}</span></p>
						<!-- <ul v-else class="msg">
							<li><span class="value">￥21</span>（预售票，不含酒）</li>
							<li><span class="value">￥21</span>（预售票，不含酒）</li>
							<li><span class="value">￥21</span>（预售票，不含酒）</li>
						</ul> -->
					</li>
				</ul>
				<button class="want" :class="{active: want}"><span class="glyphicon glyphicon-eye-open"></span><span class="num">{{wantNum}}</span>人想看</button>
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
					<div class="desc"><pre>{{show.show_message}}</pre></div>
					<ul class="row band">
						<li v-for="band in bands" class="col-lg-4 col-sm-6">
							<div :index="band.band_id">
								<img v-if="band.band_cover" :src="'/GuDao/Public/img/band/' + band.band_id + '/' + band.band_cover">
								<img v-else src="/GuDao/Public/img/band/default.jpg">
								<p>{{band.band_name}}</p>
							</div>
						</li>
					</ul>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="comment">
					<div class="send-box">
						<div class="media">
							<div class="media-left">
								<a href="#">
									<img class="media-object" src="/GuDao/Public/img/user/default.jpg">
								</a>
							</div>
							<div class="media-body">
								<textarea maxlength="140"></textarea>
								<div class="bottom">
									<p><span>0</span>/140</p>
									<button class="send">发送</button>
								</div>
							</div>
						</div>
					</div>

					<ul class="comment-list media-list">
						<li v-for="comment in comments" :commentid="comment.comment_id" :userid="comment.user_id" class="comment media">
							<div class="media-left">
								<a href="#">
									<img v-if="comment.user.headshot" class="media-object" :src="'/GuDao/Public/img/user/' + comment.user.headshot">
									<img v-else class="media-object" src="/GuDao/Public/img/user/default.jpg">
								</a>
							</div>
							<div class="media-body">
								<div class="comment-content">
									<div class="media-heading">
										<p class="name"><a :href="'../User/user?id=' + comment.user_id">{{comment.user.username}}</a></p>
										<p class="time">{{comment.comment_time}}</p>
									</div>
									<p>{{comment.comment_content}}</p>
									<a class="reply"><span class="glyphicon glyphicon-comment"></span>回复</a>
								</div>

								<div class="reply-box">
									<textarea maxlength="100"></textarea>
									<div class="bottom">
										<p><span>0</span>/100</p>
										<button class="send">发送</button>
									</div>
								</div>
								<ul class="reply-list media-list">
									<li v-for="reply in comment.reply" class="media">
										<div class="media-left">
											<a href="#">
												<img v-if="reply.user.headshot" class="media-object" :src="'/GuDao/Public/img/user/' + reply.user.headshot">
												<img v-else class="media-object" src="/GuDao/Public/img/user/default.jpg">
											</a>
										</div>
										<div class="media-body">
											<div class="reply-content">
												<div class="media-heading">
													<p class="name"><a href="">{{reply.user.username}}</a>&ensp;回复&ensp;<a href="">{{reply.target.username}}</a></p>
													<p class="time">{{reply.reply_time}}</p>
												</div>
												<p>{{reply.reply_content}}</p>
												<a class="reply"><span class="glyphicon glyphicon-comment"></span>回复</a>
											</div>
											<div class="reply-box">
												<textarea maxlength="100"></textarea>
												<div class="bottom">
													<p><span>0</span>/100</p>
													<button class="send">发送</button>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
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
<script type="text/javascript" src="/GuDao/Public/js/Show/showDetail.js"></script>

<script>
$(function() {

});
</script>

</body>
</html>