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
		$(document).ajaxStart(function() {
			setLoading();
		}).ajaxStop(function() {
			removeLoading();
		});

		this.getShow();
		this.getBand();
		this.getWantNum();
		this.checkWant();
		this.getComment();
	},
	mounted: function() {
		this.$nextTick(function () {
			var tabList = ["#detail", "#comment"];
			var tabIndex = tabList.indexOf(location.hash);
			$(".tablist li:eq(" + tabIndex +")").addClass("active");
			$(".tablist .underline").addClass("tab" + (tabIndex + 1));
			$(tabList[tabIndex]).addClass("in").addClass("active");
			$(".tablist a").unbind("click").click(function () {
				location.href = location.toString().split("#")[0] + $(this).attr("href");
				$(".tablist .underline").removeClass("tab1 tab2").addClass($(this).parent()[0].className);
			});

			$(".want").unbind("click").click(this.toggleWant);
		});
	},
	updated: function () {
		this.$nextTick(function () {
			var _this = this;
			$(document).scrollTop(0);

			var textareaPadding = 12 * 1 * 2;
			$("textarea").on("input", function () {
				if((this.scrollHeight - textareaPadding) > $(this).height()) {
					$(this).height(this.scrollHeight - textareaPadding);
				}
				$(this).next().find("span").text(this.value.length);
			});

			$(".band div").unbind("click").click(function() {
				location.href = "../Band/detail?id=" + $(this).attr("index");
			});

			$(".send-box .send").unbind("click").click(function() {
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
							_this.getComment();
						}
					}
				});
			});

			$(".reply").unbind("click").click(function() {
				$(this).parent().next(".reply-box").toggle();
			});

			$(".reply-box .send").unbind("click").click(function() {
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
						"type": 1,
						"user_id": sessionStorage.getItem("userID"),
						"target_id": send.parents(".comment").attr("Userid")
					},
					success: function(result) {
						if(result.code === 200) {
							// console.log(result);
							send.parent().prev("textarea").val("");
							$(".reply-box").hide();
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

						var time = data.show_time.toString();
						time = time.substr(0, time.length - 3);
						data.show_time = time;

						_this.show = data;
						// console.log(_this.show);
					}
				}
			});
		},
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
		toggleWant: function() {
			var _this = this;
			var user_id = sessionStorage.getItem("userID");
			var show_id = location.search.substr(1).split("=")[1];
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
			} else {
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
						// console.log(_this.comments);
					}
				}
			});
		}
	}
});