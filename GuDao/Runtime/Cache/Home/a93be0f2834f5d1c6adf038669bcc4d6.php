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
		<div>
			<ul class="tablist nav nav-tabs" role="tablist">
				<li class="tab1" role="presentation"><a href="#show" aria-controls="show" role="tab" data-toggle="tab">演出</a></li>
				<li class="tab2" role="presentation"><a href="#picture" aria-controls="picture" role="tab" data-toggle="tab">图片</a></li>
				<li class="tab3" role="presentation"><a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">评论</a></li>
				<span class="underline"></span>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade" id="show">演出列表</div>
				<div role="tabpanel" class="tab-pane fade" id="picture">图片列表</div>
				<div role="tabpanel" class="tab-pane fade" id="comment">评论列表</div>
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
	$.ajax({
		url: "/GuDao/index.php/Home/Band/getInitial",
		dataType: "json",
		success: function(result) {
			console.log(result);
		}
	});
	$.ajax({
		url: "/GuDao/index.php/Home/Band/getBandByID",
		type: "GET",
		dataType: "json",
		data: {
			"id": location.search.toString().substr(1).split("=")[1]
		},
		success: function(result) {
			// console.log(result);
		}
	});
	$.ajax({
		url: "/GuDao/index.php/Home/Band/getSupportUserNum",
		type: "GET",
		dataType: "json",
		data: {
			"id": location.search.toString().substr(1).split("=")[1]
		},
		success: function(result) {
			// console.log(result);
		}
	});
	// $.ajax({
	// 	url: "/GuDao/index.php/Home/Band/checkSupport",
	// 	type: "GET",
	// 	dataType: "json",
	// 	data: {
	// 		"user_id": sessionStorage.getItem("userID"),
	// 		"band_id": location.search.toString().substr(1).split("=")[1]
	// 	},
	// 	success: function(result) {
	// 		// console.log(result);
	// 	}
	// });
	$.ajax({
		url: "/GuDao/index.php/Home/Band/getExperience",
		type: "GET",
		dataType: "json",
		data: {
			"id": location.search.toString().substr(1).split("=")[1]
		},
		success: function(result) {
			// console.log(result);
		}
	});
	$.ajax({
		url: "/GuDao/index.php/Home/Band/getPictureByBand",
		type: "GET",
		dataType: "json",
		data: {
			"id": location.search.toString().substr(1).split("=")[1]
		},
		success: function(result) {
			// console.log(result);
		}
	});
	$.ajax({
		url: "/GuDao/index.php/Home/Band/getCommentNReply",
		type: "GET",
		dataType: "json",
		data: {
			"target": 2,
			"id": location.search.toString().substr(1).split("=")[1]
		},
		success: function(result) {
			// console.log(result);
		}
	});
	

	var tabList = ["#show", "#picture", "#comment"];
	var tabIndex = tabList.indexOf(location.hash);
	$(".tablist li:eq(" + tabIndex +")").addClass("active");
	$(".tablist .underline").addClass("tab" + (tabIndex + 1));
	$(tabList[tabIndex]).addClass("in").addClass("active");
	$(".tablist a").unbind("click").click(function () {
		location.href = location.toString().split("#")[0] + $(this).attr("href");
		$(".tablist .underline").removeClass("tab1 tab2").addClass($(this).parent()[0].className);
	});
});
</script>

</body>
</html>