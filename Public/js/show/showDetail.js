new Vue({
	el: '#gudao',
	data: {
		loginFlag: false,
		show: {},
		bands: [],
		wantNum: 0,
		want: false,
		comments: []
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
		this.checkLogin();
		this.getShow();
		this.getBand();
		this.getWantNum();
		this.checkWant();
		this.getComment();
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
		// 检查是否已登录
		checkLogin: function() {
			var _this = this;
			if(sessionStorage.getItem("userID")) {
				_this.loginFlag = true;
			}
		},
		// 获取演出信息
		getShow: function() {
			var _this = this;
			$.ajax({
				url: "getShowByID",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;

						// 删除show_time最后三个字符
						var time = data.show_time.toString();
						time = time.substr(0, time.length - 3);
						data.show_time = time;

						_this.show = data;
					}
				}
			});
		},
		// 获取乐队列表
		getBand: function() {
			var _this = this;
			$.ajax({
				url: "getBandByShow",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						_this.bands = result.data;
					}
				}
			});
		},
		// 获取“想看”数量
		getWantNum: function() {
			var _this = this;
			$.ajax({
				url: "getWantUserNum",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						_this.wantNum = result.data;
					}
				}
			});
		},
		// 检查是否“想看”
		checkWant: function() {
			var _this = this;
			if(_this.loginFlag) {
				$.ajax({
					url: "checkWant",
					type: "POST",
					dataType: "json",
					data: {
						"user_id": sessionStorage.getItem("userID"),
						"show_id": location.search.substr(1).split("=")[1],
					},
					success: function(result) {
						if(result.code === 200) {
							_this.want = true;
						}
					}
				});
			}
		},
		// 切换“想看”状态
		toggleWant: function() {
			var _this = this;

			if(!_this.loginFlag) {
				setAlertBox({
					className: "text",
					close: true,
					title: "孤岛提示",
					message: "登录可以进行更多操作哦！"
				});
				return;
			}

			// 判断演出状态
			if(this.show.show_state == 2 || this.show.show_state == 4) {
				setAlertBox({
					className: "text",
					close: true,
					title: "孤岛提示",
					message: "该演出状态下不能进行“想看”操作"
				});
				return;
			}

			// 获取ID信息
			var user_id = sessionStorage.getItem("userID");
			var show_id = location.search.substr(1).split("=")[1];

			// 取消“想看”状态
			if($(".want").hasClass("active")) {
				$.ajax({
					url: "deleteWant",
					type: "POST",
					dataType: "json",
					data: {
						"user_id": sessionStorage.getItem("userID"),
						"show_id": location.search.substr(1).split("=")[1]
					},
					success: function(result) {
						if(result.code === 200) {
							_this.wantNum --;
							_this.want = false;
						}
					}
				});
			}
			// 新增“想看”状态
			else {
				// 设置“想看”时间
				var time = new Date();
				time = time.getFullYear() + "-" + (time.getMonth() + 1) + "-" + time.getDate();

				$.ajax({
					url: "addWant",
					type: "POST",
					dataType: "json",
					data: {
						"user_id": sessionStorage.getItem("userID"),
						"show_id": location.search.substr(1).split("=")[1],
						"time": time
					},
					success: function(result) {
						if(result.code === 200) {
							_this.wantNum ++;
							_this.want = true;
						}
					}
				});
			}
		},
		// 切换选项卡
		switchTab: function(e) {
			var tabList = ["detail", "comment"];
			$(".underline")[0].className = "underline";
			$(".underline").addClass("tab" + (tabList.indexOf($(e.target).attr("aria-controls")) + 1));
		},
		// 跳转至乐队详细页
		toBandDetail: function(index) {
			location.href = "../Band/detail?id=" + index;
		},
		// 获取评论列表
		getComment: function() {
			var _this = this;
			$.ajax({
				url: "getCommentNReply",
				type: "GET",
				dataType: "json",
				data: {
					"target": 1,
					"id": location.search.substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						_this.comments = result.data;
					}
				}
			});
		},
		// textarea自适应高度
		textareaAutoHeight: function(e) {
			var textareaPadding = 12 * 1 * 2;
			if((e.target.scrollHeight - textareaPadding) > $(e.target).height()) {
				$(e.target).height(e.target.scrollHeight - textareaPadding);
			}
			$(e.target).next().find("span").text(e.target.value.length);
		},
		// 切换显示回复框
		toggleReplyBox: function(e) {
			$(e.currentTarget).parent().next(".reply-box").toggle();
		},
		// 发送评论
		sendComment: function(e) {
			var _this = this;

			if(!_this.loginFlag) {
				setAlertBox({
					className: "text",
					close: true,
					title: "孤岛提示",
					message: "登录可以进行更多操作哦！"
				});
				return;
			}

			var send = $(e.target);

			// 获取表单内容
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
				url: "sendComment",
				type: "POST",
				dataType: "json",
				data: {
					"content": content,
					"user_id": sessionStorage.getItem("userID"),
					"time": time,
					"target": 1,
					"target_id": location.search.substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						send.parent().prev("textarea").val("");
						// 重新获取评论列表
						_this.getComment();
					}
				}
			});
		},
		// 发送回复
		sendReply: function(e) {
			var _this = this;
			var send = $(e.target);

			if(!_this.loginFlag) {
				setAlertBox({
					className: "text",
					close: true,
					title: "孤岛提示",
					message: "登录可以进行更多操作哦！"
				});
				return;
			}

			// 获取表单内容
			var content = send.parent().prev("textarea").val();
			if(!content) {
				setAlertBox({
					className: "text",
					close: true,
					title: "孤岛提示",
					message: "请输入会回复内容"
				});
				return;
			}
			// 设置发送时间
			var time = new Date();
			time = time.getFullYear() + "-" + (time.getMonth() + 1) + "-" + time.getDate() + " " + time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds();
			
			$.ajax({
				url: "replyComment",
				type: "POST",
				dataType: "json",
				data: {
					"comment_id": send.parents(".comment").attr("commentid"),
					"content": content,
					"time": time,
					"user_id": sessionStorage.getItem("userID"),
					"target_id": send.parents(".comment").attr("Userid")
				},
				success: function(result) {
					if(result.code === 200) {
						send.parent().prev("textarea").val("");
						$(".reply-box").hide();
						// 重新获取评论列表
						_this.getComment();
					}
				}
			});
		}
	}
});