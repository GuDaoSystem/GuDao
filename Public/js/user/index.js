new Vue({
	el: '#gudao',
	data: {
		loginFlag: false,
		info: {},
		want: 0,
		support: 0,
		activity: [],
		reply: [],
		shows: [],
		bands: []
	},
	components: {
		"navbar": navbar,
		"back-to-top": backToTop,
		"copyright": copyright
	},
	created: function() {
		// 加载动画
		$(document).ajaxStart(function() {
			setLoading();
		}).ajaxStop(function() {
			removeLoading();
		});

		// 获取数据
		this.init();
		// this.getUserInfo();
		// this.getActivity();
		// this.getReply();
	},
	mounted: function() {
		this.$nextTick(function () {
		});
	},
	updated: function () {
		this.$nextTick(function () {
		});
	},
	computed: {
	},
	methods: {
		init: function() {
			if(location.hash == "#message") {
				$(".tablist li").removeClass("active");
				$(".tabList li.tab2").addClass("active");
				$(".underline")[0].className = "underline";
				$(".underline").addClass("tab2");
				$(".tab-pane").removeClass("in active");
				$("#message").addClass("in active");
			}
			
			var _this = this;
			$.ajax({
				url: "../../GuDao/Index/checkLogin",
				dataType: "json",
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						if(data.age) {
							data.age = new Date().getFullYear() - data.birthday.split("-")[0];
						}
						_this.info = data;
						_this.getActivity();
						_this.getReply();
					} else {
						setAlertBox({
							className: "text",
							close: true,
							title: "孤岛提示",
							message: "请先进行登录",
							buttons: [{
								value: "去登录",
								callback: function() {
									location.href = "../../GuDao/Index/login";
								}
							}, {
								value: "取消",
								callback: function() {
									location.href = "../../GuDao/Index/home"
								}
							}]
						});
					}
				}
			});
		},
		// 页面初始化
		// init: function() {
		// 	console.log(location.hash);
		// 	if(location.hash == "#message") {
		// 		$(".tablist li").removeClass("active");
		// 		$(".tabList li.tab2").addClass("active");
		// 		$(".underline")[0].className = "underline";
		// 		$(".underline").addClass("tab2");
		// 		$(".tab-pane").removeClass("in active");
		// 		$("#message").addClass("in active");
		// 	}
		// },
		// // 获取用户信息
		// getUserInfo: function() {
		// 	_this = this;
		// 	$.ajax({
		// 		url: "../../GuDao/User/getUserBasicInfo",
		// 		type: "GET",
		// 		dataType: "json",
		// 		data: {
		// 			"id": sessionStorage.getItem("userID")
		// 		},
		// 		success: function(result) {
		// 			// console.log(result);
		// 			if(result.code === 200) {
		// 				var data = result.data;
		// 				data.age = new Date().getFullYear() - data.birthday.split("-")[0];
		// 				_this.info = result.data;
		// 			}
		// 		}
		// 	});
		// },
		// 获取用户动态
		getActivity: function() {
			_this = this;
			$.ajax({
				url: "../../GuDao/User/getUserActivity",
				type: "GET",
				dataType: "json",
				data: {
					// "id": sessionStorage.getItem("userID")
					"id": _this.info.user_id
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						var data = result.data;
						_this.want = data.want;
						_this.support = data.support;
						_this.activity = data.activity;
						// console.log(_this.activity);
						for(var i = 0; i < data.activity.length; i++) {
							if(data.activity[i]["type"] == "show") {
								_this.shows.push(data.activity[i]["show"]);
							} else {
								_this.bands.push(data.activity[i]["band"]);
							}
						}
					}
				}
			});
		},
		// 获取用户收到的回复
		getReply: function() {
			_this = this;
			$.ajax({
				url: "../../GuDao/User/getReplyByUser",
				type: "GET",
				dataType: "json",
				data: {
					// "id": sessionStorage.getItem("userID")
					"id": _this.info.user_id
				},
				success: function(result) {
					// console.log(result);
					_this.reply = result.data;
					// console.log(_this.reply);
				}
			});
		},
		// 切换选项卡
		switchTab: function(e) {
			var tabList = ["activity", "message", "show", "band"];
			if(e.target.tagName.toLowerCase() == "a") {
				$(".underline")[0].className = "underline";
				$(".underline").addClass("tab" + (tabList.indexOf($(e.target).attr("aria-controls")) + 1));
			}
		},
		// 切换至演出选项卡
		toShowTab: function() {
			$(".tablist li").removeClass("active");
			$(".tabList li.tab3").addClass("active");
			$(".underline")[0].className = "underline";
			$(".underline").addClass("tab3");
			$(".tab-pane").removeClass("in active");
			$("#show").addClass("active");
			setTimeout(function() {
				$("#show").addClass("in");
			}, 200);
		},
		// 切换至乐队选项卡
		toBandTab: function() {
			$(".tablist li").removeClass("active");
			$(".tabList li.tab4").addClass("active");
			$(".underline")[0].className = "underline";
			$(".underline").addClass("tab4");
			$(".tab-pane").removeClass("in active");
			$("#band").addClass("active");
			setTimeout(function() {
				$("#band").addClass("in");
			}, 200);
		},
		// 修改基本信息
		modifyInfo: function() {
			$(".info").hide();
			$(".modify-form").css("display", "inline-block");

			if(this.info.gender == 'M') {
				$(".modify-form .female").removeClass("checked");
				$(".modify-form .male").addClass("checked");
			} else {
				$(".modify-form .male").removeClass("checked");
				$(".modify-form .female").addClass("checked");
			}

			$('#datetimepicker').datetimepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
				minView: "month"
			});

			$(".intro .count span").text($(".intro textarea").val().length);
		},
		// 选择性别
		selectGender: function(e) {
			$(".modify-form .radio").removeClass("checked");
			$(e.currentTarget).addClass("checked");
		},
		// textarea自适应高度
		textareaAutoHeight: function(e) {
			var textareaPadding = 12 * 1 * 2;
			if((e.target.scrollHeight - textareaPadding) > $(e.target).height()) {
				$(e.target).height(e.target.scrollHeight - textareaPadding);
			}
			$(e.target).next().find("span").text(e.target.value.length);
		},
		// 提交修改信息
		submitModify: function() {
			// 获取字段信息
			var name = $(".modify-form .name").val();
			if($(".modify-form .radio-box .male").hasClass("checked")) {
				var gender = 'M';
			} else {
				var gender = 'F';
			}
			var birthday = $(".modify-form .birthday input").val();
			var intro = $(".modify-form .intro textarea").val();

			$.ajax({
				url: "../../GuDao/User/modifyUserInfo",
				type: "POST",
				dataType: "json",
				data: {
					// "id": sessionStorage.getItem("userID"),
					"id": _this.info.user_id,
					"username": name,
					"gender": gender,
					"birthday": birthday,
					"intro": intro
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						_this.getUserInfo();
						_this.cancelModify();
						// $(".modify-form").hide();
						// $(".info").show();
					} else {
						setAlertBox({
							className: "text",
							close: true,
							title: "孤岛提示",
							message: result.msg
						});
					}
				}
			});
		},
		// 取消修改信息
		cancelModify: function() {
			$(".info").show();
			$(".modify-form").hide();
		},
		// 全部标为已读
		readAll: function() {
			var _this = this;
			var reply = this.reply;
			for(var i = 0; i < reply.length; i++) {
				if(reply[i].isread == 0) {
					$.ajax({
						url: "../../GuDao/User/readMessage",
						type: "POST",
						dataType: "json",
						data: {
							"id": reply[i].reply_id
						}
					});
					_this.reply[i].isread = 1;
				}
			}
		},
		// 展开消息
		openMessage: function(e) {
			$("#message li").removeClass("open-state").addClass("close-state");
			$(e.target).parents("li").removeClass("close-state").addClass("open-state");
		},
		// 关闭消息
		closeMessage: function(e) {
			$(e.target).parents("li").removeClass("open-state").addClass("close-state");
			if(!$(e.target).parents("li").hasClass("read")) {
				$.ajax({
					url: "../../GuDao/User/readMessage",
					type: "POST",
					dataType: "json",
					data: {
						"id": $(e.target).parent().attr("index")
					},
					success: function(result) {
						if(result.code == 200) {
							$(e.target).parents("li").addClass("read");
						}
					}
				});
			}
		},
		// 发送回复
		sendReply: function(e) {
			var _this = this;
			var send = $(e.target);

			var content = send.parent().prev("textarea").val();
			if(!content) {
				setAlertBox({
					className: "text",
					close: true,
					title: "孤岛提示",
					message: "请输入评论内容"
				});
				return;
			}
			// 设置发送时间
			var time = new Date();
			time = time.getFullYear() + "-" + (time.getMonth() + 1) + "-" + time.getDate() + " " + time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds();
			
			$.ajax({
				url: "../../GuDao/User/replyMessage",
				type: "POST",
				dataType: "json",
				data: {
					"comment_id": send.parents("li").attr("comment"),
					"content": content,
					"time": time,
					"type": 1,
					// "user_id": sessionStorage.getItem("userID"),
					"user_id": _this.info.user_id,
					"target_id": send.parents("li").attr("user")
				},
				success: function(result) {
					if(result.code === 200) {
						// console.log(result);
						send.parent().prev("textarea").val("");
						$(".reply-box").hide();
					}
				}
			});
		},
		// 跳转至演出详细页
		toShowDetail: function(index) {
			location.href = "../../GuDao/Show/detail?id=" + index;
		},
		// 跳转至乐队详细页
		toBandDetail: function(index) {
			location.href = "../../GuDao/Band/detail?id=" + index;
		}
	}
});