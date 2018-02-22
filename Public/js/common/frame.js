$(function() {
	$(document).ajaxStart(function() {
		console.log("start");
		setLoading();
	}).ajaxStop(function() {
		console.log("stop");
		removeLoading();
	});


	// 检查登录状态
	// sessionStorage.setItem("userID", 1);
	if(sessionStorage.getItem("userID")) {
		$(".didnotLogin").hide();
	} else {
		$(".didLogin").hide();
	}


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
					sessionStorage.removeItem("userID");
					location.reload();
				}
			}, {
				value: "取消"
			}]
		});
	});


	// 返回顶部
	$(document).scroll(function() {
		if($(document).scrollTop() > 150) {
			$(".back-to-top").removeClass("hide-back-to-top").addClass("show-back-to-top");
		} else if($(".back-to-top").hasClass("show-back-to-top")) {
			$(".back-to-top").removeClass("show-back-to-top").addClass("hide-back-to-top");
		}
	});
	$(".back-to-top").click(function() {
		$(document).scrollTop(0);
	});


	// 查看原图
	$("img.thumbnail").click(function() {
		setAlertBox({
			className: "image",
			close: true,
			maskClose: true,
			message: "<img src=" + this.src +">",
			buttons: []
		});
		if($(".alert-box.image .message").height() > $(".alert-box.image .box").height()) {
			$(".alert-box.image .message").height($(".alert-box.image .box").height() - 72);
		}
	});
});