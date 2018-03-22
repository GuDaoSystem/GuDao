new Vue({
	el: '#gudao',
	data: {
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
			// 标签页定位
			var tabList = ["#show", "#picture", "#comment"];
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

			// textarea高度自适应 & 动态显示textarea内容字数
			var textareaPadding = 12 * 1 * 2;
			$("textarea").on("input", function () {
				if((this.scrollHeight - textareaPadding) > $(this).height()) {
					$(this).height(this.scrollHeight - textareaPadding);
				}
				$(this).next().find("span").text(this.value.length);
			});
		});
	},
	computed: {
	},
	methods: {
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
					// console.log(result);
					_this.band = result.data;
				}
			});
		},
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
					// console.log(result);
					_this.supportNum = result.data;
				}
			});
		},
		checkSupport: function() {
			var _this = this;
			$.ajax({
				url: "checkSupport",
				type: "POST",
				dataType: "json",
				data: {
					"user_id": sessionStorage.getItem("userID"),
					"band_id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						_this.support = true;
					}
				}
			});
		},
		toggleSupport: function(e) {
			var _this = this;

			// 获取ID信息
			var user_id = sessionStorage.getItem("userID");
			var band_id = location.search.substr(1).split("=")[1];

			console.log(user_id, band_id);

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
					// console.log(result);
					_this.shows = result.data;
				}
			});
		},
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
					// console.log(result);
					_this.pictures = result.data;
				}
			});
		},
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
					// console.log(result);
					_this.comments = result.data;
				}
			});
		},
		toShowDetail: function(index) {
			location.href = "../Show/detail?id=" + index + "#detail";
		},
		toggleShowReplyBox: function(e) {
			$(e.currentTarget).parent().next(".reply-box").toggle();
		},
		sendComment: function(e) {
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
						// console.log(result);
						send.parent().prev("textarea").val("");
						// 重新获取评论列表
						_this.getComment();
					}
				}
			});
		},
		replyComment: function(e) {
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
						// console.log(result);
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