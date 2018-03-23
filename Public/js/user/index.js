new Vue({
	el: '#gudao',
	data: {
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
		this.getUserInfo();
		this.getActivity();
		this.getReply();
	},
	mounted: function() {
		this.$nextTick(function () {
			var _this = this;

			// 事件选择器
			$('#datetimepicker').datetimepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
				minView: "month"
			});

			// 标签页定位
			var tabList = ["#activity", "#message", "#show", "#band"];
			var tabIndex = tabList.indexOf(location.hash);
			$(".tablist li:eq(" + tabIndex +")").addClass("active");
			$(".tablist .underline").addClass("tab" + (tabIndex + 1));
			$(tabList[tabIndex]).addClass("in").addClass("active");

			// 标签页切换
			$(".tablist a").unbind("click").click(function () {
				// console.log(tabIndex, $(this).parent()[0])
				if(tabIndex == 1 && !$(this).parent().hasClass("tab2")) {
					// console.log(_this.reply);
					var reply = _this.reply;
					var count = 0;
					for(var i = 0; i < reply.length; i++) {
						if(reply[i].read == 0) {
							$.ajax({
								url: "readMessage",
								type: "POST",
								dataType: "json",
								data: {
									"id": reply[i].reply_id,
								},
								success: function(result) {
									if(result.code === 200) {
										// _this.getReply();
										_this.reply[i].read = 1;
									} else {
										count++;
									}
								}
							});
						}
					}
					if(count == 0) {
						$(".didLogin .message a").removeClass("tips");
					}
				}
				tabIndex = $(".tablist li").index($(this).parent());

				location.href = location.toString().split("#")[0] + $(this).attr("href");
				$(".tablist .underline")[0].className = "underline";
				$(".tablist .underline").addClass($(this).parent()[0].className);
			});
		});
	},
	updated: function () {
		this.$nextTick(function () {
			var _this = this;

			// 设置性别单选框默认选项
			if(this.info.gender == 'M') {
				$(".modify-form .female").removeClass("checked");
				$(".modify-form .male").addClass("checked");
			} else {
				$(".modify-form .male").removeClass("checked");
				$(".modify-form .female").addClass("checked");
			}
			// 监听性别单选框
			$(".modify-form .radio").click(function() {
				$(".modify-form .radio").removeClass("checked");
				$(this).addClass("checked");
			});

			// textarea高度自适应 & 动态显示textarea内容字数
			var textareaPadding1 = 12 * 0.5 * 2;
			$(".modify-form textarea").next().find("span").text($("textarea").val().length);
			$(".modify-form textarea").on("input", function () {
				if((this.scrollHeight - textareaPadding1) > $(this).height()) {
					$(this).height(this.scrollHeight - textareaPadding1);
				}
				$(this).next().find("span").text(this.value.length);
			});
			var textareaPadding2 = 12 * 1 * 2;
			$(".reply-box textarea").on("input", function () {
				if((this.scrollHeight - textareaPadding2) > $(this).height()) {
					$(this).height(this.scrollHeight - textareaPadding2);
				}
				$(this).next().find("span").text(this.value.length);
			});

			// 监听“修改基本信息”按钮
			$(".info .modify-info").click(function() {
				$(".info").hide();
				$(".modify-form").css("display", "inline-block");
			});

			// 监听修改基本信息中“确认”按钮
			$(".modify-form .confirm").unbind("click").click(function() {
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
					url: "modifyUserInfo",
					type: "POST",
					dataType: "json",
					data: {
						"id": sessionStorage.getItem("userID"),
						"username": name,
						"gender": gender,
						"birthday": birthday,
						"intro": intro,
					},
					success: function(result) {
						console.log(result);
						if(result.code === 200) {
							_this.getUserInfo();
							$(".modify-form").hide();
							$(".info").show();
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
			});
			// 监听修改基本信息中“取消”按钮
			$(".modify-form .cancel").click(function() {
				$(".modify-form").hide();
				$(".info").show();
			});

			// 监听消息展开或收起
			$("#message .content").unbind("click").click(function() {
				if($(this).parent().hasClass("close-state")) {
					$("#message li").removeClass("open-state").addClass("close-state");
					$(this).parent().removeClass("close-state").addClass("open-state");
				} else {
					$(this).parent().removeClass("open-state").addClass("close-state");
				}
			});

			// 监听“发送”按钮
			$("#message .reply-box .send").click(function() {
				var send = $(this);

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
					url: "replyMessage",
					type: "POST",
					dataType: "json",
					data: {
						"comment_id": send.parents("li").attr("comment"),
						"content": content,
						"time": time,
						"type": 1,
						"user_id": sessionStorage.getItem("userID"),
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
			});
		});
	},
	computed: {
	},
	methods: {
		// 获取用户信息
		getUserInfo: function() {
			_this = this;
			$.ajax({
				url: "getUserBasicInfo",
				type: "GET",
				dataType: "json",
				data: {
					"id": sessionStorage.getItem("userID")
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						var data = result.data;
						data.age = new Date().getFullYear() - data.birthday.split("-")[0];
						_this.info = result.data;
					}
				}
			});
		},
		// 获取用户动态
		getActivity: function() {
			_this = this;
			$.ajax({
				url: "getUserActivity",
				type: "GET",
				dataType: "json",
				data: {
					"id": sessionStorage.getItem("userID")
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						var data = result.data;
						_this.want = data.want;
						_this.support = data.support;
						_this.activity = data.activity;
						console.log(_this.activity);
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
				url: "getReplyByUser",
				type: "GET",
				dataType: "json",
				data: {
					"id": sessionStorage.getItem("userID")
				},
				success: function(result) {
					// console.log(result);
					_this.reply = result.data;
					// console.log(_this.reply);
				}
			});
		}
	}
});