$(function() {
	// 加载动画
	$(document).ajaxStart(function() {
		setLoading();
	}).ajaxStop(function() {
		removeLoading();
	});


	// 检查登录状态
	$.ajax({
		url: "../../GuDao/Index/checkLogin",
		dataType: "json",
		success: function(result) {
			if(result.code === 200) {
				$(".didnotLogin").hide();
				var data = result.data;

				if(data.headshot) {
					$(".didLogin img").attr("src", "../../GuDao/Public/img/user/" + data.headshot);
				} else {
					$(".didLogin img").attr("src", "../../GuDao/Public/img/user/default.jpg");
				}

				// 个人中心
				$(".user-page").click(function(e) {
					e.preventDefault();
					location.href = "../../GuDao/User";
				});

				// 我的消息
				$.ajax({
					url: "../../GuDao/User/hasUnreadMessage",
					type: "GET",
					dataType: "json",
					data: {
						"id": data.user_id
					},
					success: function(result) {
						if(result.code === 200) {
							$(".didLogin .message a").addClass("tips");
						}
					}
				});
				$(".message").click(function(e) {
					e.preventDefault();
					location.href = "../../GuDao/User#message";
				});

				// 退出登录
				$(".logout").click(function(e) {
					e.preventDefault();
					setAlertBox({
						className: "text",
						close: true,
						title: "孤岛提示",
						message: "您确定要退出登录吗？",
						buttons: [{
							value: "确定",
							callback: function() {
								$.ajax({
									url: "../../GuDao/Index/logout"
								});
								location.href = "../../GuDao/Index/home";
							}
						}, {
							value: "取消"
						}]
					});
				});
			} else {
				$(".didLogin").hide();
			}
		}
	});


	// 导航栏avtive状态
	var pathname = location.pathname;
	var model = pathname.split("/")[2];
	if(model == "Notice") {
		$("ul.menu li:eq(1)").addClass("active");
	} else if(model == "Show") {
		$("ul.menu li:eq(2)").addClass("active");
	} else if(model == "Band") {
		$("ul.menu li:eq(3)").addClass("active");
	} else {
		var page = pathname.split("/")[3];
		if(page == "home") {
			$("ul.menu li:eq(0)").addClass("active");
		} else if(page == "login") {
			$(".didnotLogin a:eq(0)").addClass("active");
		} else if(page == "register") {
			$(".didnotLogin a:eq(1)").addClass("active");
		}
	}


	// 搜索按钮
	$(".search-box button").click(function() {
		search();
	});
	$(".search-box input").keydown(function(e) {
		if(e.keyCode == 13) {
			e.preventDefault();
			search();
		}
	});
	function search() {
		if(/^ *$/.test($(".search-box input").val())) {
			setAlertBox({
				className: "text",
				close: true,
				title: "孤岛提示",
				message: "请输入搜索内容"
			});
		} else {
			location.href = "../../GuDao/Index/search" + "?key=" + $(".search-box input").val();
		}
	}


	// 返回顶部
	if($(document).scrollTop() > 150) {
		$(".back-to-top").show().addClass("show-back-to-top");
	} else {
		$(".back-to-top").hide();
	}
	$(document).scroll(function() {
		if($(document).scrollTop() > 150) {
			$(".back-to-top").show().removeClass("hide-back-to-top").addClass("show-back-to-top");
		} else if($(".back-to-top").hasClass("show-back-to-top")) {
			$(".back-to-top").show().removeClass("show-back-to-top").addClass("hide-back-to-top");
		}
	});
	$(".back-to-top").click(function() {
		$(document).scrollTop(0);
	});


	// 查看原图
	$(document).click(function(e) {
		if(e.target.tagName.toLowerCase() == "img" && $(e.target).hasClass("thumbnail")) {
			setAlertBox({
				className: "image",
				close: true,
				maskClose: true,
				message: "<img src=" + e.target.src +">",
				buttons: []
			});
			if($(".alert-box.image .message").height() > $(".alert-box.image .box").height()) {
				$(".alert-box.image .message").height($(".alert-box.image .box").height() - 72);
			}
		}
	});
});