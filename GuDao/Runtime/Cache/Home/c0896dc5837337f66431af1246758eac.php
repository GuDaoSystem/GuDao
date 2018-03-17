<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css">
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/frame.css">

<style type="text/css">
/*	#search .searchbox .input-group{
		float:left;
		font-size:1.4rem;
	}
	#search .searchbox .input-group input{
		height:40px;
		background: #0d0d0d;
		border-radius: .3rem 0 0 .3rem;
		border: .1rem solid #333;
		border-right: none;

	}
	#search .searchbox .input-group .input-group-addon{
		height:40px;
		padding: 0;
		background: #0d0d0d;
		border: .1rem solid #333;
		border-left: none;		
	}
	#search .searchbox .input-group .input-group-addon button{
		font-size: 2rem;
		background: inherit;
		border: none;
		padding: 0;
		padding-right: 8px;
	}*/

	#search .searchbox1{
		width: calc(100% - 185px);
		vertical-align: middle;
		display: inline-block;
		height: 40px;
		margin-bottom: 2rem;
	}

	#search .searchbox1 input{
		width: calc(100% - 40px);
		vertical-align: top;
		height: 100%;
		border: 1px solid #333;
		border-radius: 3px 0 0 3px;
		border-right: none;
	}
	#search .searchbox1 button{
		
		width: 40px;
		font-size: 2rem;
		vertical-align: top;
		height:100%;
		border: 1px solid #333;
		border-radius: 0 3px 3px 0;
		border-left: none;
		padding-right: 8px;
	}
	#search .conditions1{
		vertical-align: middle;
		height: 40px;
		line-height: 40px;
		font-size: 1.4rem;
		display: inline-block;
		color: #333;
		width: 180px;
		float: right;
	}
	#search .conditions1 span{
		padding: 0 5px 0 5px;
	}

	.head{
		margin-bottom: 0.8rem;
	}
	
	.head .title{
	display: inline-block;
	padding: 0.2rem 0.5rem;
	border-top: 1px solid #ffd700;
	border-left: 4px solid #ffd700; 

	}
	.head .more{
	padding-top: 0.4rem;
	float: right;
	}

	.new-notice .body li{
		border-width: 1px;
		border-style: solid;
		border-color: #333;
		padding: .8rem;
		margin-bottom: .8rem;

	}

	.new-notice .body .state{
		font-size: 2rem;
		color: #333;

	}
	.new-notice .body p{
		width: calc(100% - 120px);
		display: inline-block;
	}

	.new-notice .body .time{
		float: right;
		width:120px;
		line-height: 26px;
	}



</style>
<script type="text/javascript" src="/GuDao/Public/js/common/jquery-3.2.1.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/bootstrap.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/vue.js"></script>
</head>
<body>

<div id="gudao">	
	<!-- 导航条 -->
	<navbar></navbar>

	<!-- 内容 -->
	<div id="search" class="container content">
		<!-- <div class="searchbox">
			<div class="input-group">
	  			<input type="text" class="form-control" placeholder="搜索通知、演出、乐队...">
	  			<span class="input-group-addon" id="">
	  				<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
	  			</span>
			</div>
  			<div class="conditons">	
	  			<span>all</span>
	  			<span>notice</span>
	  			<span>shows</span>
	  			<span>bands</span>
  			</div>
		</div> -->

		<div class="searchbox1">
			<input type="text"><button>
				<span class="glyphicon glyphicon-search"></span>
			</button>
		</div>
		<div class="conditions1">
			<span>全部</span>|<span>通知</span>|<span>演出</span>|<span>乐队</span>
		</div>

		<div class="new-notice">
			<div class="head">
				<p class="title">通知</p>
				<a href="" class="more">MORE</a>
			</div>
			<ul class="body">
				<li>
					<p><span  class="state">预售/</span>&ensp;noticesnotices</p>
					<p class="time">2017年12月10日</p>
				</li>
				<li v-for="item in notice">
					<p><span  class="state" v-if="item.notice_type=='1'">预售/</span><span  class="state" v-if="item.notice_type=='2'">取消/</span><span  class="state" v-if="item.notice_type=='3'">变更/</span>&ensp;{{item.notice_content}}</p>
					<p class="time">{{item.notice_time}}</p>
				</li>


					
				</li>
			</ul>
		</div>
		<p v-if="result">{{result}}</p>


	




	</div>

	<!-- 底部 -->
	<back-to-top></back-to-top>
	<copyright></copyright>
</div>


<script type="text/javascript" src="/GuDao/Public/js/common/common.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/component.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/common/frame.js"></script>
<script type="text/javascript" src="/GuDao/Public/js/index/search.js"></script>

<script>
// $(function() {
// 	$.ajax({
// 		url: "doSearch",
// 		type: "POST",
// 		dataType: "json",
// 		data: {
// 			"key": ["未来", "广州"]
// 		},
// 		success: function(result) {
// 			console.log(result);
// 		}
// 	});
// });
</script>

</body>
</html>