new Vue({
	el: '#gudao',
	data: {
		// 自动加载相关变量
		loadFlag: true,
		pageIndex: 2,
		// 通知列表
		notices: []
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
		this.getNotice();
		this.scrollToBottom();
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
		// 获取通知列表
		getNotice: function() {
			var _this = this;
			$.ajax({
				url: "../../GuDao/Notice/getNoticeByPage",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex": 1,
					"pageSize": 10
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						if(data.length < 10) {
							$(".no-more").show();
						}
						for(var i = 0; i < data.length; i++) {
							var time = data[i].notice_time.toString().split(" ")[0].split("-");
							data[i].notice_time = time[0] + "年" + time[1] + "月" + time[2] + "日";
						}
					}
					_this.notices = result.data;
				}
			});
		},
		// 按通知类型获取通知列表
		getNoticeByType: function(e) {
			var _this = this;
			if(e.target.tagName.toLowerCase() == "a" && !$(e.target).hasClass("active")) {
				// 设置active样式
				$(".condition a").removeClass("active");
				$(e.target).addClass("active");
				// 重设自动加载相关变量
				_this.resetLoad();

				$.ajax({
					url: "../../GuDao/Notice/getNoticeByPage",
					type: "GET",
					dataType: "json",
					data: {
						"pageIndex": 1,
						"pageSize": 10,
						"type": $(".condition a").index($(e.target))
					},
					success: function(result) {
						if(result.code === 200) {
							var data = result.data;
							if(data.length < 10) {
								$(".no-more").show();
								_this.loadFlag = false;
							}
							for(var i = 0; i < data.length; i++) {
								var time = data[i].notice_time.toString().split(" ")[0].split("-");
								data[i].notice_time = time[0] + "年" + time[1] + "月" + time[2] + "日";
							}
						}
						_this.notices = result.data;
					}
				});
			}
		},
		// 滚动至底部自动加载数据
		scrollToBottom: function() {
			var _this = this;
			$(window).scroll(function(){
		    	if(_this.loadFlag && $(window).height() + $(window).scrollTop() == $(document).height()) {
		    		// 防止多次加载
		    		_this.loadFlag = false;

		    		$.ajax({
		        		url: "../../GuDao/Notice/getNoticeByPage",
						type: "GET",
						dataType: "json",
						data: {
							"pageIndex": ++_this.pageIndex,
							"pageSize": 5,
							"type": $(".condition a").index($(".condition .active"))
						},
						success: function(result) {
							if(result.code === 200) {
								var data = result.data;
								for(var i = 0; i < data.length; i++) {
									var time = data[i].notice_time.toString().split(" ")[0].split("-");
									data[i].notice_time = time[0] + "年" + time[1] + "月" + time[2] + "日";
									_this.notices.push(data[i]);
								}
								if(data.length < 5) {
									$(".no-more").show();
									_this.loadFlag = false;
								} else {
									_this.loadFlag = true;
								}
							} else {
								$(".no-more").show();
							}
						}
		        	});
		    	}
		    });
		},
		// 重设自动加载相关变量
		resetLoad: function() {
			this.loadFlag = true,
			this.pageIndex = 2;
			$(".no-more").hide();
		},
		// 跳转至演出详细页
		toShowDetail: function(index) {
			location.href = "../../GuDao/Show/detail?id=" + index + "#detail";
		}
	}
});