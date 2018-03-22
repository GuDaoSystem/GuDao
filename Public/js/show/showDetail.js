new Vue({
	el: '#gudao',
	data: {
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
		this.getShow();
		this.getBand();
		this.getWantNum();
		this.checkWant();
		this.getComment();
	},
	mounted: function() {
		this.$nextTick(function () {
			// 监听“想看”按钮
			$(".want").unbind("click").click(this.toggleWant);

			// 标签页定位
			var tabList = ["#detail", "#comment"];
			var tabIndex = tabList.indexOf(location.hash);
			$(".tablist li:eq(" + tabIndex +")").addClass("active");
			$(".tablist .underline").addClass("tab" + (tabIndex + 1));
			$(tabList[tabIndex]).addClass("in").addClass("active");

			// 标签页切换
			$(".tablist a").unbind("click").click(function () {
				location.href = location.toString().split("#")[0] + $(this).attr("href");
				$(".tablist .underline")[0].className = "underline";
				$(".tablist .underline").addClass($(this).parent()[0].className);
			});
		});
	},
	updated: function () {
		this.$nextTick(function () {
			var _this = this;
			$(document).scrollTop(0);

			// 监听乐队列表
			$(".band div").unbind("click").click(function() {
				location.href = "../Band/detail?id=" + $(this).attr("index");
			});

			// textarea高度自适应 & 动态显示textarea内容字数
			var textareaPadding = 12 * 1 * 2;
			$("textarea").on("input", function () {
				if((this.scrollHeight - textareaPadding) > $(this).height()) {
					$(this).height(this.scrollHeight - textareaPadding);
				}
				$(this).next().find("span").text(this.value.length);
			});

			// 监听评论框“发送”按钮
			$(".send-box .send").unbind("click").click(function() {
				var send = $(this);

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
							// console.log(result);
							send.parent().prev("textarea").val("");
							// 重新获取评论列表
							_this.getComment();
						}
					}
				});
			});

			// 监听“回复”按钮
			$(".reply").unbind("click").click(function() {
				$(this).parent().next(".reply-box").toggle();
			});

			// 监听回复框“发送”按钮
			$(".reply-box .send").unbind("click").click(function() {
				var send = $(this);

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
							// console.log(result);
							send.parent().prev("textarea").val("");
							$(".reply-box").hide();
							// 重新获取评论列表
							_this.getComment();
						}
					}
				});
			});
		});
	},
	computed: {
	},
	methods: {
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
						// console.log(_this.show);
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
						// console.log(_this.bands);
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
						// console.log(_this.want);
					}
				}
			});
		},
		// 检查是否“想看”
		checkWant: function() {
			var _this = this;
			$.ajax({
				url: "checkWant",
				type: "POST",
				dataType: "json",
				data: {
					"user_id": sessionStorage.getItem("userID"),
					"show_id": location.search.substr(1).split("=")[1],
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						_this.want = true;
					}
				}
			});
		},
		// 切换“想看”状态
		toggleWant: function() {
			var _this = this;

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
					// console.log(result.data[1].reply);
					if(result.code === 200) {
						_this.comments = result.data;
						console.log(_this.comments);
					}
				}
			});
		}
	}
});