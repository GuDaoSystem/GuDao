new Vue({
	el: '#gudao',
	data: {
		loginFlag: false,
		band: {},
		supportNum: 0,
		support: false,
		shows: [],
		pictures: [],
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
		this.getBand();
		this.getSupportNum();
		this.checkSupport();
		this.getShows();
		this.getPicture();
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
		// 获取乐队信息
		getBand: function() {
			var _this = this;
			$.ajax({
				url: "getBandByID",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						_this.band = result.data;
					}
				}
			});
		},
		// 获取“支持”数量
		getSupportNum: function() {
			var _this = this;
			$.ajax({
				url: "getSupportUserNum",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						_this.supportNum = result.data;
					}
				}
			});
		},
		// 检查是否“支持”
		checkSupport: function() {
			var _this = this;
			if(_this.loginFlag) {
				$.ajax({
					url: "checkSupport",
					type: "POST",
					dataType: "json",
					data: {
						"user_id": sessionStorage.getItem("userID"),
						"band_id": location.search.toString().substr(1).split("=")[1]
					},
					success: function(result) {
						if(result.code === 200) {
							_this.support = true;
						}
					}
				});
			}
		},
		// 切换“支持”状态
		toggleSupport: function(e) {
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

			// 获取ID信息
			var user_id = sessionStorage.getItem("userID");
			var band_id = location.search.substr(1).split("=")[1];

			// 取消“支持”状态
			if(_this.support) {
				$.ajax({
					url: "deleteSupport",
					type: "POST",
					dataType: "json",
					data: {
						"user_id": sessionStorage.getItem("userID"),
						"band_id": location.search.substr(1).split("=")[1]
					},
					success: function(result) {
						if(result.code === 200) {
							_this.supportNum --;
							_this.support = false;
						}
					}
				});
			}
			// 新增“支持”状态
			else {
				// 设置“支持”时间
				var time = new Date();
				time = time.getFullYear() + "-" + (time.getMonth() + 1) + "-" + time.getDate();

				$.ajax({
					url: "addSupport",
					type: "POST",
					dataType: "json",
					data: {
						"user_id": sessionStorage.getItem("userID"),
						"band_id": location.search.substr(1).split("=")[1],
						"time": time
					},
					success: function(result) {
						if(result.code === 200) {
							_this.supportNum ++;
							_this.support = true;
						}
					}
				});
			}
		},
		// 切换选项卡
		switchTab: function(e) {
			var tabList = ["show", "picture", "comment"];
			$(".underline")[0].className = "underline";
			$(".underline").addClass("tab" + (tabList.indexOf($(e.target).attr("aria-controls")) + 1));
		},
		// 获取乐队列表
		getShows: function() {
			var _this = this;
			$.ajax({
				url: "getExperience",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						_this.shows = result.data;
					}
				}
			});
		},
		// 跳转至演出详细页
		toShowDetail: function(index) {
			location.href = "../Show/detail?id=" + index;
		},
		// 获取图片
		getPicture: function() {
			var _this = this;
			$.ajax({
				url: "getPictureByBand",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						_this.pictures = result.data;
					}
					
				}
			});
		},
		// 获取评论列表
		getComment: function() {
			var _this = this;
			$.ajax({
				url: "getCommentNReply",
				type: "GET",
				dataType: "json",
				data: {
					"target": 2,
					"id": location.search.toString().substr(1).split("=")[1]
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
		toggleShowReplyBox: function(e) {
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
					"target": 2,
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
			var send = $(e.currentTarget);

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